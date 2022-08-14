const form = document.querySelector('.login form');
const continueBtn = form.querySelector('.button input');
const errorText = form.querySelector('.error-txt');

form.onsubmit = (e)=>{
    e.preventDefault();  //Ajax用にフォームの送信を防止する
}

continueBtn.onclick = ()=>{
    // let's start Ajax
    let ajax = new XMLHttpRequest();    // creating XML object
    ajax.open('POST', './javascript/php/login.php', true);
    ajax.onload = ()=>{
        if(ajax.readyState === XMLHttpRequest.DONE) {
            if(ajax.status === 200) {
                let data = ajax.response;
                console.log(data);
                if (data == 'success') {
                    location.href = 'users.php'; 
                }else {
                    errorText.textContent = data;       // インライン要素からブロック要素に変えるのでstyle指定の前に配置した方がよい。(ただしChromeではstyleの後に記述しても正常に表示された)
                    errorText.style.display = "block";
                }
            }
        }
    }
    // フォームデータをAjaxで送信する
    let formData = new FormData(form);  // 入力フォームのオブジェクトを生成
    ajax.send(formData);                // 入力フォームのデータをlogin.phpにAjax送信する

}