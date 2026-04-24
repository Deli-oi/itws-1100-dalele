// BROKEN COPY — XSS vulnerable
// Only the finishQuiz leaderboard section is changed

$(document).ready(function () {

    var questions   = [];
    var currentIdx  = 0;
    var score       = 0;
    var playerName  = '';
    var total       = 10;

    $('#start-form').on('submit', function (e) {
        e.preventDefault();
        playerName = $('#player-name').val().trim();
        if (!playerName) return;

        $.getJSON('php/get_questions.php', function (data) {
            questions  = data;
            total      = questions.length;
            currentIdx = 0;
            score      = 0;
            $('#q-total').text(total);
            $('#score').text(0);
            showScreen('quiz');
            renderQuestion();
        }).fail(function () {
            alert('Could not load questions. Please try again.');
        });
    });

    function renderQuestion() {
        var q = questions[currentIdx];
        $('#q-num').text(currentIdx + 1);
        $('#question-text').text(q.question);

        var options = shuffle([q.correct_answer, q.wrong1, q.wrong2, q.wrong3]);
        var $opts = $('#options').empty();

        $.each(options, function (i, opt) {
            $('<button>')
                .addClass('option-btn')
                .text(opt)
                .data('correct', opt === q.correct_answer)
                .on('click', function () { handleAnswer($(this)); })
                .appendTo($opts);
        });
    }

    function handleAnswer($clicked) {
        $('.option-btn').prop('disabled', true);

        if ($clicked.data('correct')) {
            $clicked.addClass('correct');
            score++;
            $('#score').text(score);
        } else {
            $clicked.addClass('wrong');
            $('.option-btn').filter(function () {
                return $(this).data('correct') === true;
            }).addClass('correct');
        }

        setTimeout(function () {
            currentIdx++;
            if (currentIdx < total) {
                renderQuestion();
            } else {
                finishQuiz();
            }
        }, 1200);
    }

    function finishQuiz() {
        showScreen('results');
        $('#final-score').text('You scored ' + score + ' out of ' + total + '!');

        $.post('php/save_score.php',
            { name: playerName, score: score, total: total },
            function (data) {
                if (data.leaderboard) {
                    var $tbody = $('#leaderboard-body').empty();
                    $.each(data.leaderboard, function (i, row) {
                        // VULNERABLE: player_name injected directly into HTML
                        $tbody.append(
                            '<tr><td>' + row.player_name + '</td>' +
                            '<td>' + row.score + ' / ' + row.total + '</td></tr>'
                        );
                    });
                }
            },
        'json');
    }

    $('#play-again').on('click', function () {
        $('#player-name').val('');
        showScreen('start');
    });

    function showScreen(name) {
        $('#start-screen, #quiz-screen, #results-screen').hide();
        $('#' + name + '-screen').show();
    }

    function shuffle(arr) {
        var a = arr.slice();
        for (var i = a.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var t = a[i]; a[i] = a[j]; a[j] = t;
        }
        return a;
    }

});
