
function money(n){
  return new Intl.NumberFormat("id-ID",{style:"currency",currency:"IDR",minimumFractionDigits:2}).format(n);
}
function go(page){ window.location.href=page; }
function saveUser(user){ localStorage.setItem("kazeUser",JSON.stringify(user)); }
function getUser(){ try{return JSON.parse(localStorage.getItem("kazeUser"))}catch(e){return null} }
function getProfile(){
  const u=getUser()||{};
  return {
    name:u.name||"Kaze",
    id:u.id||"061108",
    email:u.email||"kaze061108@gmail.com"
  };
}
function addTransaction(item, amount, method=""){
  const list=JSON.parse(localStorage.getItem("kazeTransactions")||"[]");
  list.unshift({item,amount,method,date:new Date().toLocaleString("id-ID")});
  localStorage.setItem("kazeTransactions",JSON.stringify(list));
}
function getBalance(){return Number(localStorage.getItem("kazeBalance")||1000000)}
function setBalance(v){localStorage.setItem("kazeBalance",String(v))}

function applyTheme(){
  const dark=localStorage.getItem("kazeDarkMode")==="on";
  document.body.classList.toggle("dark-mode",dark);
}
function initSettings(){ applyTheme(); }
