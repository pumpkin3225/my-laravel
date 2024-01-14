<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ColorWeakness</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0px;
        padding: 0px;
        background-color: firebrick;
    }


    .container {
        width: 100%;
        height: 100vh;
        display: none;
        flex-direction: column;
        flex-wrap: wrap;
        align-items: center;
        gap: 30px;
    }

    .plate {
        height: 600px;
        width: 600px;
        background-color: aliceblue;
        border-radius: 15px;
        display: flex;
        flex-wrap: wrap;
        padding: 15px;
        gap: 15px;
    }

    .main {
        position: relative;
    }

    .prompt {
        width: 160px;
        height: 50px;
        color: aliceblue;
        background-color: rgb(52, 91, 142);
        position: absolute;
        text-align: center;
        top: 0;
        left: -230%;
        border-radius: 20px;
        border: solid 5px;
        font-size: 30px;
        cursor: pointer;
    }

    .prompt:hover {
        background-color: rgb(54, 77, 109);
    }

    .prompt:active {
        background-color: rgb(34, 59, 93);
        box-shadow: 0px 0px 2px 3px rgb(74, 74, 74);
    }

    .time {
        width: 160px;
        height: 50px;
        background-color: aliceblue;
        position: absolute;
        top: 0;
        right: -230%;
        border-radius: 20px;
        border: lightcoral solid 5px;
        text-align: center;
        font-size: 30px;
    }

    .box {
        border-radius: 15px;
        cursor: pointer;
    }


    .btn-warning {
        font-size: 50px;
        width: 300px;
        border-radius: 10px;
    }

    .prelevel {
        background-color: aliceblue;
        width: 250px;
        height: 50px;
        border-radius: 15px;
        border: cadetblue solid 5px;
        text-align: center;
        font-size: 30px;
    }

    .score {
        background-color: aliceblue;
        width: 100px;
        height: 50px;
        border-radius: 5px;
        border: goldenrod solid 5px;
        text-align: center;
        font-size: 30px;
    }

    .title {
        width: 600px;
        margin: auto;
        text-align: center;
        margin-top: 10%;
    }

    .title p {
        color: black;
        font-size: 70px;
        margin-bottom: 70px;
    }

    .hi {
        display: flex;
    }

    .he {
        display: unset;
    }

    .bye {
        display: none;
    }

    .ansboder {
        border: solid 5px rgb(0, 0, 0);
    }
</style>

<body>
    <div class="title">
        <p>你 是 色 弱 嗎 ?</p>
        <p> {{$first}}</p>
        <p> {{$tests->first()->img_path}}</p>
        <button type="button" class="btn-warning start">開始測驗</button>
    </div>
    <div class="container">
        <div class="prelevel"></div>
        <div class="main">
            <div class="time"></div>
            <div class="score"></div>
            <div class="prompt"></div>
        </div>

        <div class="plate"></div>
        <button type="button" class="btn-warning clear ">重來</button>
    </div>
    <script>

        // 宣告-----
        const plate = document.querySelector('.plate');
        const clear = document.querySelector('.clear');
        const preLevel = document.querySelector('.prelevel');
        const preScore = document.querySelector('.score');
        const start = document.querySelector('.start');
        const container = document.querySelector('.container');
        const title = document.querySelector('.title');
        const prePrompt = document.querySelector('.prompt');
        const preTimes = document.querySelector('.time');
        const minOpacity = 0.2
        const maxOpacity = 0.8
        const maxStage = 10
        let count = 1;
        let level = 1;
        let score = 0;
        let limit = 3;
        // let time = 30
        let timer;
        let seconds = 10; // 設定初始時間
        let stopTimer = false; // 控制是否停止計時器的標誌
        // 頁面讀取--
        addBoxes(count);
        getWidth(level);
        addLevel(level);
        addScore(score);
        addPrompt(limit);
        addTimes();
        // 互動----

        // 答案----
        plate.addEventListener('click', function (event) {
            // 假設元素class含有box => ture 再配驚嘆號反轉 變成false 就不會被return
            if (event.target.classList.contains('plate')) return ;
            if (event.target.classList.contains('mis')) alert('錯了') ;
            if (event.target.classList.contains('ans')) {
                stopTimer = true;
                plate.innerHTML = '';
                score++
                count = addto3(count);
                addLevel(level);
                addScore()
                addBoxes();
                // 石頭沒丟水溝---
                stopTimer = false;
                clearInterval(timer);
                countdown(10);
            }
        })
        // 提示---
        prePrompt.addEventListener('click', function () {
            limit = minusLimit(limit);
            addPrompt();
        })
        // 重來----
        clear.addEventListener('click', function () {
            stopTimer = true;
            count = 1;
            level = 1;
            score = 0;
            limit = 3;
            plate.innerHTML = '';
            addBoxes();
            addLevel(level);
            addScore();
            addPrompt();
            // 石頭沒丟水溝---
            stopTimer = false;
            clearInterval(timer);
            countdown(10);
        })
        // 開始----
        start.addEventListener('click', function () {
            stopTimer = true;
            let ans = document.querySelector('ans')
            count = 1;
            level = 1;
            score = 0;
            limit = 3;
            plate.innerHTML = '';
            addBoxes();
            addLevel(level);
            addScore();
            addPrompt();
            stopTimer = false;
            clearInterval(timer);
            countdown(10);
            // 石頭沒丟水溝---

            container.classList.add('hi');
            title.classList.add('bye');
        })
        // function---
        function addBoxes(width) {
            color = rgbColor();
            boxCount = getBoxCount(level);
            widthpx = getWidth(level);
            opacity = getOpacity(level);
            const ansNumber = getRandom(boxCount, 0);
            for (let i = 0; i < boxCount; i++) {
                if (i == ansNumber) {
                    plate.innerHTML += `<div class="box ans"
                    style = "width:${widthpx}px; height: ${widthpx}px;
                    background-color: rgba(${color.r}, ${color.g}, ${color.b},${opacity});"></div>`;
                } else {
                    plate.innerHTML += `<div class="box mis"
                    style = "width:${widthpx}px; height: ${widthpx}px;
                    background-color: rgba(${color.r}, ${color.g}, ${color.b},1);"></div>`;
                }
            }
        }
        function addLevel(level) {
            preLevel.innerHTML = `等級${level}`
        }
        function addScore() {
            preScore.innerHTML = `${score}分`
        }
        function addTimes() {
            preTimes.innerHTML = `剩下10秒`
        }
        function addPrompt() {
            prePrompt.innerHTML = `使用提示${limit}`
        }
        function getOpacity(c) {
            return lerp(0.2, 0.9, c / 10)
        }
        function lerp(a, b, t) {
            return a + (b - a) * t;
        }

        function rgbColor() {
            r = getRandom(256, 0);
            g = getRandom(256, 0);
            b = getRandom(256, 0);
            return { r: r, g: g, b: b };
        }
        function getRandom(max, min) {
            return Math.floor(Math.random() * max + min);
        }

        function addto3(c) {
            if (c < 3) {
                c++;
            } else {
                level++;
                c = 1;
            }
            return c;

        }
        function getWidth(lv) {
            return (570 - (15 * lv)) / (lv + 1);
        }
        function getBoxCount(lv) {
            lv = (lv + 1) * (lv + 1);
            return lv;
        }
        function minusLimit(c) {
            let ans = document.querySelector('.ans')
            if (c > 0) {
                c--;
                ans.classList.add('ansboder');
            } else if (c == 0) {
                c = 0;
            }
            return c;
        }
        function countdown(c) {
            seconds = c
            timer = setInterval(() => {
                if (seconds > 0 && !stopTimer) {
                    preTimes.innerHTML = `剩下${seconds}秒` // 可以改成顯示在網頁上的元素
                    seconds--;
                    console.log(seconds);
                } else {
                    clearInterval(timer);
                    preTimes.innerHTML = `計時結束` // 可以改成顯示在網頁上的元素
                    container.classList.remove('hi');
                    title.classList.remove('bye');
                }
            }, 800);
        }

    </script>
</body>

</html>
