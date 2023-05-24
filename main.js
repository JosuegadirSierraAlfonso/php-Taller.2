let myFormulario = document.querySelector("#myFormulario");
let myHeaders = new Headers({"Content-Type": "applicatio/json"});
let config = {
    headers: myHeaders,
}
myFormulario.addEventListener("submit", async(e)=>{
    e.preventDefault();
    config.method = "POST";
    let data = Object.fromEntries(new FormData(e.target));
    config.body = JSON.stringify(data);
    let res = await (await fetch("api.php", config)).text();
    document.querySelector("pre").innerHTML=res;
    console.log(res);
    
})