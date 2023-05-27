// file control writing on page/application from (.json) and packing to file or database
// decided to make two users in one file cuz of optimalisation data size on server

// trzeba tworzyć schemat pakowania wiadomości do pliku json poprzez klasę
// ważne informacje to: kto pisał, nr wiadomości na chacie, czas przyjęcia wiadomości do bazy/serwera, wiadomość
// problemem może być dodawanie plików typu obrazki, filmiki czy wiadomości głosowe, prawdopodobnie zajmie się tym osobna baza danych
//      można zrobić tablicę gdzie jej numer zawsze równa się numerowi wiadomości, a w komórce przechowywany jest
//          typ wiadomości, wtedy wystarczy nazwać plik np. id użytkownika-numerwiadomości.xyz
// przekształć czas, serwera (GMT+2) na strefę czasową użytkownika
// ---

const submitButton = document.getElementById("submit");
const messageInput = document.getElementById("textInput");
const autoReceiveInput = document.getElementById("autoReceiveMessages");

let Userinfo = {
    userId: "01",
    name: "Łukasz",
    surname: "Grynbaum",
    GlobalTime: "GMT+2"
}

let messageData = {
    userId: '',
    sender: '',
    receiver: '',
    messNumber: '',
    timeMessReception: '',
    messageContent: '',
    messageReadedNumber: ''
}

// messages to check function is working
let defaultMessages = [
    "I wondered why the baseball was getting bigger. Then it hit me.",
    "Police were called to a day care, where a three-year-old was resisting a rest.",
    "Did you hear about the guy whose whole left side was cut off? He’s all right now.",
    "The roundest knight at King Arthur’s round table was Sir Cumference.",
    "To write with a broken pencil is pointless.",
    "When fish are in schools they sometimes take debate.",
    "The short fortune teller who escaped from prison was a small medium at large.",
    "A thief who stole a calendar… got twelve months.",
    "A thief fell and broke his leg in wet cement. He became a hardened criminal.",
    "Thieves who steal corn from a garden could be charged with stalking.",
    "When the smog lifts in Los Angeles , U. C. L. A.",
    "The math professor went crazy with the blackboard. He did a number on it.",
    "The professor discovered that his theory of earthquakes was on shaky ground.",
    "The dead batteries were given out free of charge.",
    "If you take a laptop computer for a run you could jog your memory.",
    "A dentist and a manicurist fought tooth and nail.",
    "A bicycle can’t stand alone; it is two tired.",
    "A will is a dead giveaway.",
    "Time flies like an arrow; fruit flies like a banana.",
    "A backward poet writes inverse.",
    "In a democracy it’s your vote that counts; in feudalism, it’s your Count that votes.",
    "A chicken crossing the road: poultry in motion.",
    "If you don’t pay your exorcist you can get repossessed.",
    "With her marriage she got a new name and a dress.",
    "Show me a piano falling down a mine shaft and I’ll show you A-flat miner.",
    "When a clock is hungry it goes back four seconds.",
    "The guy who fell onto an upholstery machine was fully recovered.",
    "A grenade fell onto a kitchen floor in France and resulted in Linoleum Blownapart.",
    "You are stuck with your debt if you can’t budge it.",
    "Local Area Network in Australia : The LAN down under.",
    "He broke into song because he couldn’t find the key.",
    "A calendar’s days are numbered."
];

// download data from mess writed by user accesable to add to database
function getDataMessage() {
    let user = ["user0", "user1"];
    var sender = ''; // who added the message
    var messNumber = 0;
    var timeMessReception = 0;  // time in GMT+2 when server get message
    //var readedTime = 0; // time when other user readed message maybe included to project in a future
    var messageContent = '';        // temporary
    var messageReadedNumber = [];   // contain nbr of message who readed sender1, sender2

    // check file userID-friendID.json
}


function randomMessage() {
    if (document.getElementById("autoReceiveMessage").checked == false) {
        return;
    } else {
        let message = defaultMessages[(Math.random() * defaultMessages.length) | 0];
        newMessagePrint("other", message);
    }
}

// test message from friend
randomMessage();

function sendMessage() {
    let message = document.getElementById("textInput").value;
    newMessagePrint("you", message);
}

function newMessagePrint(writer, message) {
    // other - another user
    // you - logged user
    if (writer == "other") {
        document.getElementById("chatStory").innerHTML += "<div class=\"message other\">" + message + "</div>";
    } else {
        if (document.getElementById("textInput").value == '') {
            return;
        }
        document.getElementById("chatStory").innerHTML += "<div class=\"message you\">" + message + "</div>";
    }
    scrollToBottom();
    document.getElementById("textInput").value = '';
}

function scrollToBottom() {
    var scrollToNewMessage = document.getElementById("chatStory");
    scrollToNewMessage.scrollTop = scrollToNewMessage.scrollHeight;
}

function addDataToJSON(author, messageQueue, messageContent) {
    // add data to database
}

function printing(arg) {
    console.clear;
    console.log(arg);
}

