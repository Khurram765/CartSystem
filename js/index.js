let nameError = document.getElementById("namee")
let emailError = document.getElementById("emaile")
let passwordError = document.getElementById("passworde")
let addressError = document.getElementById("addresse")
let phoneError = document.getElementById("numbere")
let formControl = document.querySelectorAll(".signupcontrol")
let errorr = document.querySelectorAll(".error")


Array.from(formControl).forEach((fc,ind)=>{
    fc.addEventListener("focus",()=>{
        errorr[ind].innerHTML=""
    })
})

function myFunction(){
    let fname = document.forms["myForm"]["name"].value
    let email = document.forms["myForm"]["email"].value
    let password = document.forms["myForm"]["password"].value
    let address = document.forms["myForm"]["address"].value
    let phone = document.forms["myForm"]["number"].value
    let validRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if(fname=="" || fname.length<3){
        nameError.innerHTML="Please enter valid name"
        return false
    }
    if(email=="" || !email.match(validRegex)){
        emailError.innerHTML="Please enter valid email"
        return false
    }
    if(password=="" || password.length<6){
        passwordError.innerHTML="Please enter valid passsword(minimum 6 characters)"
        return false
    }
    if(address==""){
        addressError.innerHTML="Please fill out this field"
        return false
    }
    if(phone=="" || phone.length<9 || phone.length>11){
        phoneError.innerHTML="Please enter valid Number"
        return false
    }
}


let loginError = document.querySelectorAll(".loginerror")
let loginControl = document.querySelectorAll(".logincontrol")
Array.from(loginControl).forEach((le,lin)=>{
    le.addEventListener("focus",()=>{
        loginError[lin].innerHTML = ''
    })
})

function loginfunction(){
    let loginEmail = document.forms["loginform"]["email"].value
    let loginPassword = document.forms["loginform"]["password"].value
    let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(loginEmail=="" || !loginEmail.match(emailRegex)){
        loginError[0].innerHTML = "Please enter valid Email"
        return false
    }
    if(loginPassword == ""){
        loginError[1].innerHTML = "Please enter valid password"
        return false
    }
}


let quantity = document.querySelectorAll(".quantity");
Array.from(quantity).forEach(q=>{
    q.addEventListener("change",()=>{
        if(q.value<1){
            q.value = 1
        }
    })
})