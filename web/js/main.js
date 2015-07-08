//main.js
//todo:jquery化したい

function registTone(tone) {
    var href = "/regist/" + tone;
    if (tone !== "") {
        var ret = confirm(tone + "を登録するよ");
        if (ret === true) {
            location.href = href;
        }
    }
}

function clearTone() {
    var tones =     document.getElementById("toneTxt").value;
    if(tones.length > 0){
        tones = tones.substr(0 , tones.length - 1);
    }
    document.getElementById("toneTxt").value = tones;
}

window.onload = function() {
    document.getElementById("registBtn").onclick = function() {
        var tone = document.getElementById("toneTxt").value;
        registTone(tone);
    };

    document.getElementById("clearBtn").onclick = function() {
        clearTone();
    };
};
