// 1 - Quando clicar em Login, fazer o formulário sair da tela, indo para baixo
const btnLogin = document.querySelector(".btn-login");
const form = document.querySelector("form");

// ouve eventos clique
btnLogin.addEventListener("click", (event) => {
    event.preventDefault();

    // 2 - Fazer o formulário dizer não-não (vibrar) caso haja campos vazios.
    const fields = [...document.querySelectorAll(".input-block input")]; // procura os campos

    fields.forEach((field) => {
        if (field.value === "") form.classList.add("validate-error");
    }); // se em cada campo que olhar um deles estiver vazio add ao form inteiro que esta com erro

    //para continuar animando msm apos um clique, em seguida faça:
    const formError = document.querySelector(".validate-error");
    if (formError) {
        formError.addEventListener("animationend", (event) => {
            if (event.animationName === "nono") {
                formError.classList.remove("validate-error");
            }
        });
    } else {
        form.classList.add("form-hide");
    } // 2 - FIM
}); // 1 - FIM

// 3 - Fazendo a rolagem não aparecer e sumindo realmente com a animação

//Condição para quando inicia a animação
form.addEventListener("animationstart", (event) => {
    if (event.animationName === "down") {
        document.querySelector("body").style.overflow = "hidden";
    }
});

//Condição para quando termina a animação
form.addEventListener("animationend", (event) => {
    if (event.animationName === "down") {
        //if - esta especificando qual das animações deve ser ouvida para então executar
        form.style.display = "none";
        document.querySelector("body").style.overflow = "none";
        //retornando o overflow
    }
}); // 3 - FIM

// 4 - Background Squares
const ulSquares = document.querySelector("ul.squares");

for (let i = 0; i < 11; i++) {
    // Estilização
    const random = (min, max) => Math.random() * (max - min) + min; // criando tam randomicos - evitando a repetição no cod

    const li = document.createElement("li");

    const size = Math.floor(random(10, 120));

    const position = random(1, 99);

    li.style.width = `${size}px`;
    li.style.height = `${size}px`;
    li.style.bottom = `-${size}px`;

    li.style.left = `${position}%`;

    // Animação
    const delay = random(0.1, 5);
    const duration = random(24, 12);

    li.style.animationDelay = `${delay}s`;
    li.style.animationDuration = `${duration}s`;
    li.style.animationTimingFunction = `cubic-bezier(${Math.random()}, ${Math.random()}, ${Math.random()}, ${Math.random()})`; // cada li ficará com o tempo diferente uma da outra

    // criando li's
    ulSquares.appendChild(li);
}