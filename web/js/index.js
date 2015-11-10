//http://jsdo.it/butchi/ujBN
//Copyright (c) 2015 butchi
//Released under the MIT license
//https://github.com/YukinobuKurata/YouTubeMagicBuyButton/blob/master/MIT-LICENSE.txt
/*global $, jQuery, alert*/


// forked from butchi's "グレイコードカウンタの歌" http://jsdo.it/butchi/uJj5
'use strict';
var bpm = 150; // BPM
var intv = 60 / bpm * 1000; // インターバル(ms)
var cnt = 0;

var timer;

var cArr = [0, 2, 4, 5, 7, 9, 11, 12]; // 長音階（ドレミファソラシド）

var triWave = T("osc", {
	wave: 'tri'
});
var adsr = T("adsr", {
	a: 10,
	d: 150,
	s: 0,
	r: 200
});
var synth = T('*', triWave, adsr);

function getToneIndex() {
	var toneCode,
		toneChar;
	toneCode = $('#toneTxt').val();
	if (toneCode === "") {
		return 0;
	} else {
		toneChar = toneCode.charAt(cnt);
	}

	if (toneCode.length <= cnt) {
		cnt = 0;
	} else {
		cnt = cnt + 1;
	}
	return Number(toneChar - 1);
}

function timerHandler() {
	//    var pitch = cArr[(cnt++) % 8];
	//    triWave.freq.value = 440 * Math.pow(2, (pitch - 9) / 12); // ラが440Hzになるような平均律
	var toneIndex,
		pitch;
	toneIndex = getToneIndex();
	if (0 <= toneIndex || toneIndex >= cArr.length) {
		pitch = cArr[toneIndex];
		triWave.freq.value = 440 * Math.pow(2, (pitch - 9) / 12); // ラが440Hzになるような平均律
		adsr.play().bang();
		synth.play().bang();
	} else {
		//pass
	}
}

function resetTimer() {
	cnt = 0;
	clearInterval(timer);
}


//１音鳴らす
function ringTone(toneVal) {
	var pitch = cArr[toneVal - 1];
	triWave.freq.value = 440 * Math.pow(2, (pitch - 9) / 12); // ラが440Hzになるような平均律
	adsr.play().bang();
	synth.play().bang();
}

function setToneToTextbox(toneVal) {
	var base = $("#toneTxt").val();
	$("#toneTxt").val(base + toneVal);
}

$('#playBtn').on('click', function() {
	resetTimer();
	timer = setInterval(timerHandler, intv);
});

$('#stopBtn').on('click', function() {
	resetTimer();
});

$('#tone').on('click', function() {
	resetTimer();
});

//todo:オブジェクティブに生成したいよね。
$('#tone1').on('click', function() {
	var tone = 1;
	ringTone(tone);
	setToneToTextbox(tone);
});

$('#tone2').on('click', function() {
	var tone = 2;
	ringTone(tone);
	setToneToTextbox(tone);
});

$('#tone3').on('click', function() {
	var tone = 3;
	ringTone(tone);
	setToneToTextbox(tone);
});

$('#tone4').on('click', function() {
	var tone = 4;
	ringTone(tone);
	setToneToTextbox(tone);
});

$('#tone5').on('click', function() {
	var tone = 5;
	ringTone(tone);
	setToneToTextbox(tone);
});

$('#tone6').on('click', function() {
	var tone = 6;
	ringTone(tone);
	setToneToTextbox(tone);
});


$('#tone7').on('click', function() {
	var tone = 7;
	ringTone(tone);
	setToneToTextbox(tone);
});


$('#tone8').on('click', function() {
	var tone = 8;
	ringTone(tone);
	setToneToTextbox(tone);
});

$('#tone9').on('click', function() {
	var tone = 9;
	//ringTone(tone);
	setToneToTextbox('_');
});
