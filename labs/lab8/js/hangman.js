var selectedWord = "";
var selectedHint = "";
var board = [];
var remainingGuesses = 6;
var words = [{ word: "snake", hint: "It's a reptile" },
             { word: "monkey", hint: "It's a mammal" },
             { word: "beetle", hint: "It's a insect" }];
var alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            
window.onload = startGame();

$('.letter').click(function() {
    checkLetter($(this).attr("id"));
    disableButton($(this));
})

$('.replayBtn').on("click", function() {
   location.reload(); 
});

$('.hint').click(function() {
    $('#hint').append("<br> Hint:" + selectedHint);
    remainingGuesses--;
    updateMan();
    disableButton($(this));
});

$('#letterBtn').click(function () {
    var boxVal = $('#letterBox').val();
})
function startGame() {
    pickWord();
    initBoard();
    createHint();
    createLetters();
    updateBoard();
}

            
function pickWord() {
    var randomInt = Math.floor(Math.random() * words.length);
    selectedWord = words[randomInt].word.toUpperCase();
    selectedHint = words[randomInt].hint;
}

function initBoard() {
    for (var letter in selectedWord) {
        board.push("_");
    }
}

function createLetters() {
    for (var letter of alphabet) {
        $("#letters").append("<button class='letter btn btn-success' id='" + letter + "'>" + letter + "</button>");
    }
}

function createHint() {
    $('#hint').append("<br />");
    $('#hint').append("<button class='hint btn btn-success'>Hint</button>");
}

function checkLetter(letter) {
    var positions = new Array();
    for (var i = 0; i < selectedWord.length; i++) {
        if (letter == selectedWord[i]) {
            positions.push(i);
        }
    }
    if (positions.length > 0) {
        updateWord(positions, letter);
        
        if (!board.includes('_')) {
            endGame(true);
        }
    } else {
        remainingGuesses -= 1;
        updateMan();
    }
    
    if (remainingGuesses <= 0) {
        endGame(false);
    }
}


function updateWord(positions, letter) {
    for (var pos of positions) {
        board[pos] = letter;
    }

    updateBoard();
}

function updateBoard() {
    $('#word').empty();
    
    for (var i = 0; i < board.length; i++) {
        $('#word').append(board[i] + " ");
    }
}    

function updateMan() {
    $("#hangImg").attr("src", "img/stick_" + (6 - remainingGuesses) + ".png");
}

function endGame(win) {
    $("#letters").hide();
    
    if (win) {
        $('#won').show();
    } else {
        $('#lost').show();
    }
}

function disableButton(btn) {
    btn.prop("disabled", true);
    btn.attr("class", "btn btn-danger")
}
