// accont sql
var acd;
var chatUserName = "imię";
var userID;
var chats = ["user1", "user2", "user3"];    // contain all friends list
var chatsSex = ["f", "m", "m"]; // contain friends sex
var chatsMessages = ["last message", "last message from user2", "last message from user3"];
var avatarFile = ["0-avatar.png", "1-avatar.png", "2-avatar.png"]; // temporary





function register() {
    var login = document.getElementById("user-login").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    console.log('login');

}


/* TODO:
    add sended message to db when button 
    
*/

function mainSidePrintChat() {
    for(let i = 0; i < chats.length; i++) {
        userID = '' + "0" + i;
        let id = document.getElementById(i);
        id = i;
        let iii = 'avatar' + i;
            document.getElementById('chatList').innerHTML += "<div id=\"" + userID + "\" class=\"chatArticle\"><div id=\"" + iii + "\" class=\"chatAvatar\"></div><div class=\"chatValue\"><div class=\"chatName\">" + chats[i] + "</div><div class=\"chatLastMessage\">" + chatsMessages[i] + "</div></div>";
            var elem = document.createElement("img");
            document.getElementById(iii).appendChild(elem);
            elem.src = "src/users avatars/" + i + "-avatar.png";
            elem.style.height = "100px";
            elem.style.width = "100px";
            elem.style.borderRadius = "50%";
    }
    const chatBox = document.querySelectorAll('.chatArticle');
    chatBox.forEach(box => {
        box.addEventListener('click', function handleClick(event) {
                const x = document.getElementById('chatStory');
                x.style.display = "flex";
        });
    });
}

mainSidePrintChat();
printAvatarInList();

function printAvatarInList() {
    // in progress
}