let myFormulario = document.querySelector("#myFormulario");
let myHeaders = new Headers({"Content-Type": "application/json"});
let config = {
    headers: myHeaders,
};

let registration = [];

myFormulario.addEventListener("submit", async(e) => {
    e.preventDefault();
    let formData = new FormData(e.target);
    let data = Object.fromEntries(formData);
    registration.push(data); 
    let res = await (await fetch("api.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(registration)
    })).json();
    document.querySelector("#resul").textContent = JSON.stringify(res, null, 2);
});