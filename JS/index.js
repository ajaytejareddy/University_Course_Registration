function passMatch(){
    const pwd = document.forms[1].psw.value;
    const repeated_pwd = document.forms[1].psw_repeat.value;
    const para = document.getElementById("passMatch");
  
    if(pwd!==repeated_pwd){
      
      para.innerHTML = "Password not matched";
      para.style.color = "red";

    }
    else{
      para.innerHTML = "password matched";
      para.style.color = "green";
    }
    
  }

function checkPassLength(){
      const pwd = document.forms[1].psw;
      const para = document.getElementById("passLength");
      const repeated_pwd = document.forms[1].psw_repeat.value;

      if(repeated_pwd !== "")
        passMatch();

      if(pwd.value.length <= 8){
            para.innerHTML = "password should consist atleat 8 characters";
            para.style.fontSize = '10px';
            para.style.color = 'red';
            return false;
      }
      else{
            para.innerHTML = "password should consist atleat 8 characters";
            para.style.color = 'green';
            return true;
      }
 }

function check_Validity(){
    const mailRegex = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/ig;
    const nameRegex = /^[a-z ,.'-]+$/ig;
    const idRegex = /^[0-9]{6,}$/g;
    
    const formElement = document.forms[1];

    const fname = formElement.fname.value;
    const lname = formElement.lname.value;
    const wiuid = formElement.wiuid.value;
    const email = formElement.email.value;
    const psw = formElement.psw.value;
    
    const para = document.getElementById("validityErr2");

    if(checkEmptyString(fname,lname,email,wiuid,psw)){
        topFunction();
        para.innerHTML = `Please Enter Valid information`;
        return false;
    }

    try{
        if(!regexMatcher([fname,lname,email,wiuid],[nameRegex,nameRegex,mailRegex,idRegex])){
            para.style.color = 'red';
            para.innerHTML = `Please Enter Valid information`;           
            console.log("regex");
            return false;
        }

    }
    catch(e){
        console.log(e);
        return false;
    }


    return true;
}

const checkEmptyString = (...values) => {
    for(value of values)
        if(value === "")
            return true;
}
function regexMatcher(value=[],pattern=[]){
    if(value.length !== pattern.length)
        throw new Error('pattern and form elements length should match');
    value.forEach((a,i) => {
        if(a.match(pattern[i])===null){
            return false;
        }
    });
   // console.log("true returned");
    return true;
}

function topFunction() {
    window.scrollTo(0, 0);
}

function check(){
    const formElement = document.forms[0];
    const para = document.getElementById("validityErr1");

    const email = formElement.email.value;
    const psw = formElement.psw.value;

    if(checkEmptyString(email,psw)) {   
        
        para.style.color = 'red';
        para.innerHTML = `Please Enter Email and Password`;
        
        return false;
    }
    return true;
}