const searchBar = document.querySelector('.users .search input');
const searchBtn = document.querySelector('.users .search button');
const userList = document.querySelector('.users .users-list');

searchBtn.onclick = () => {
    searchBar.classList.toggle('active');
    searchBar.focus();
    searchBtn.classList.toggle('active');
    searchBar.value = '';
}

searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;
    if(searchTerm != '') {
        searchBar.classList.add('active');
    } else {
        searchBar.classList.remove('active');
    }
    // let's start Ajax
    let ajax = new XMLHttpRequest();    // creating XML object
    // データを送信（POST）するのではなく受信（リクエスト⇔レスポンス）が目的なのでGETメソッドを使用する
    ajax.open('POST', './javascript/php/search.php', true);
    ajax.onload = ()=>{
        if(ajax.readyState === XMLHttpRequest.DONE) {
            if(ajax.status === 200) {
                let data = ajax.response;
                userList.innerHTML = data;
            }
        }
    }
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.send('searchTerm=' + searchTerm);
}

setInterval(()=>{
    // let's start Ajax
    let ajax = new XMLHttpRequest();    // creating XML object
    // データを送信（POST）するのではなく受信（リクエスト⇔レスポンス）が目的なのでGETメソッドを使用する
    ajax.open('GET', './javascript/php/users.php', true);
    ajax.onload = ()=>{
        if(ajax.readyState === XMLHttpRequest.DONE) {
            if(ajax.status === 200) {
                let data = ajax.response;
                // 検索バーに入力が無ければ(classにactiveが無ければ)HTMLを追記する。
                if(!searchBar.classList.contains('active')) {
                    userList.innerHTML = data;
                }
            }
        }
    }
    ajax.send();
}, 500);    // 0.5秒毎に実行し続ける


