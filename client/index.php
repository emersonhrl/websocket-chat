<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Chat</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <main>
        <span></span>
        <span></span>
        <span></span>
    </main>
    <div class="receive">
        <output></output>
    </div>
    <div class="send">
        <input type="text">
        <div class="button">
            <button>
                <svg viewBox="0 -960 960 960">
                    <path d="M120-160v-640l760 320-760 320Zm60-93 544-227-544-230v168l242 62-242 60v167Zm0 0v-457 457Z"/>
                </svg>
            </button>
        </div>
    </div>

    <script>
        const ws = new WebSocket('ws://10.1.1.104:8099/');
        const output = document.querySelector('output');
        const input = document.querySelector('input');
        const button = document.querySelector('button');

        ws.addEventListener('open', console.log);
        ws.addEventListener('message', console.log);

        function play() {
            var audio = new Audio('https://github.com/IonDen/ion.sound/raw/master/sounds/button_tiny.mp3');
            audio.play();
        }

        ws.addEventListener('message', message => {
            const dados = JSON.parse(message.data);
            if (dados.type === 'chat') {
                const msg = document.createElement("div");
                msg.classList.add("you");
                msg.innerHTML = dados.text;
                const hora = document.createElement("div");
                hora.classList.add("hora");
                hora.innerHTML = String(new Date().getHours()).padStart(2,'0') + ":" + String(new Date().getMinutes()).padStart(2,'0');
                output.append(msg, hora);
                play();

                output.scrollTop = output.scrollHeight;
            }
        }); 

        input.addEventListener('keypress', e => {
            if (e.code === 'Enter') {
                const valor = input.value;
                const msg = document.createElement("div");
                msg.classList.add("me");
                msg.innerHTML = valor;
                const hora = document.createElement("div");
                hora.classList.add("hora");
                hora.innerHTML = String(new Date().getHours()).padStart(2,'0') + ":" + String(new Date().getMinutes()).padStart(2,'0');
                output.append(msg, hora);
                play();
                ws.send(valor);

                output.scrollTop = output.scrollHeight;
                input.value = '';
            }
        });

        button.addEventListener('click', e => {
            const valor = input.value;
            if (valor != "") {
                const msg = document.createElement("div");
                msg.classList.add("me");
                msg.innerHTML = valor;
                const hora = document.createElement("div");
                hora.classList.add("hora");
                hora.innerHTML = String(new Date().getHours()).padStart(2,'0') + ":" + String(new Date().getMinutes()).padStart(2,'0');
                output.append(msg, hora);
                play();
                ws.send(valor);

                output.scrollTop = output.scrollHeight;
                input.value = '';
            }
        });
    </script>
</body>
</html>