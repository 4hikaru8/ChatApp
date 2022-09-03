const form = document.querySelector('.typing-area');
const inputField = form.querySelector('.input-field');
const sendBtn = form.querySelector('button');
const chatBox = document.querySelector('.chat-box');

form.onsubmit = (e)=>{
    e.preventDefault();  //Ajax用にフォームの送信を防止する
}

sendBtn.onclick = ()=>{
    // let's start Ajax
    let ajax = new XMLHttpRequest();    // creating XML object
    ajax.open('POST', './javascript/php/insert-chat.php', true);
    ajax.onload = ()=>{
        if(ajax.readyState === XMLHttpRequest.DONE) {
            if(ajax.status === 200) {
                inputField.value = '';  // 入力フォームを初期化
                scrollToBottom();
            }
        }
    }
    // フォームデータをAjaxで送信する
    let formData = new FormData(form);  // 入力フォームのオブジェクトを生成
    ajax.send(formData);                // 入力フォームのデータをinsert-chat.phpにAjax送信する
}

chatBox.onmouseenter = ()=> {
    chatBox.classList.add('active');
}

chatBox.onmouseleave = ()=> {
    chatBox.classList.remove('active');
}

setInterval(()=>{
    // let's start Ajax
    let ajax = new XMLHttpRequest();    // creating XML object
    ajax.open('POST', './javascript/php/get-chat.php', true);
    ajax.onload = ()=>{
        if(ajax.readyState === XMLHttpRequest.DONE) {
            if(ajax.status === 200) {
                let data = ajax.response;
                chatBox.innerHTML = data;
                // 最新コメントへの自動スクロールを制御する。
                if(!chatBox.classList.contains('active')) {
                    scrollToBottom();
                }
            }
        }
    }
    // フォームデータをAjaxで送信する
    let formData = new FormData(form);  // 入力フォームのオブジェクトを生成
    ajax.send(formData);                // 入力フォームのデータをinsert-chat.phpにAjax送信する
}, 500);    // 0.5秒毎に実行し続ける

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}