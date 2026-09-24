<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Kaze - Borrowing</title>
<link rel="stylesheet" href="css/style.css">
<style>
.product{font-size:40px;font-weight:700;margin-bottom:25px}.subtitle{font-size:32px;margin-bottom:25px}.content{display:grid;grid-template-columns:70% 30%;gap:25px}.duration{border:3px solid #000;border-radius:20px;overflow:hidden}.tabs{display:grid;grid-template-columns:repeat(4,1fr)}.tab{height:70px;border:0;background:#fff;font-size:28px;font-weight:700}.tab.active{border:3px solid #000;border-bottom-color:#fff;border-radius:18px 18px 0 0}.options{padding:25px 20px;display:grid;grid-template-columns:1fr 1fr;gap:25px 90px}.opt{min-height:85px;border:3px solid #000;border-radius:20px;background:#fff;font-size:28px;font-weight:700}.opt.selected{background:#000;color:#fff}.manual{grid-column:1/-1;padding:0 20px 20px;display:none}.manual.show{display:block}.manual input{width:300px;height:55px;border:3px solid #000;border-radius:15px;padding:0 12px;font-size:22px}.info{padding:5px 15px}.selected{font-size:28px;font-weight:700}.unit,.total{font-size:27px;font-weight:700;margin-top:4px}.total{margin-bottom:60px}.fine{font-size:22px;line-height:1.4;margin-bottom:25px}.borrow-btn{width:100%;height:90px;border:3px solid #000;border-radius:18px;background:#fff;font-size:28px;font-weight:700}.borrow-btn:hover{background:#000;color:#fff}
@media(max-width:900px){.content{grid-template-columns:1fr}.total{margin-bottom:25px}}@media(max-width:650px){.product{font-size:29px}.subtitle{font-size:24px}.tabs{overflow:auto}.tab{font-size:17px}.options{grid-template-columns:1fr;gap:12px;padding:15px}.opt{min-height:65px;font-size:21px}.manual{padding:0 15px 15px}.manual input{width:100%}.selected,.unit,.total{font-size:21px}.fine{font-size:18px}.borrow-btn{height:65px;font-size:22px}}
</style>
</head>
<body>
<header class="header"><div class="profile" onclick="go('profile.php')"><div class="logo">K</div><div><div class="name">Kaze</div><div class="user-id">061108</div></div></div><button class="back" onclick="go('dashboard.php')">Back</button></header>
<main class="panel"><h1 class="product" id="product">PlayStation V</h1><div class="subtitle">Select loan time</div>
<div class="content"><section class="duration"><div class="tabs">
<button class="tab active" onclick="category('hour',this)">Hour</button><button class="tab" onclick="category('day',this)">Day</button><button class="tab" onclick="category('week',this)">Weeks</button><button class="tab" onclick="category('month',this)">Month</button>
</div><div class="options" id="options"></div><div class="manual" id="manual"><label>Enter loan duration</label><input id="manualInput" type="number" min="1" placeholder="Example: 7" oninput="manualUpdate()"></div></section>
<section class="info"><div class="selected" id="selected"></div><div class="unit" id="unit"></div><div class="total" id="total"></div><div class="fine" id="fine"></div><button class="borrow-btn" onclick="startBorrow()">Start borrowing</button></section></div></main>
<script src="js/app.js"></script>
<script>
const rates={hour:{unit:"hours",price:10000,fine:5000,opts:[[1,"One hour"],[5,"Five hours"],[10,"Ten hours"],[15,"Fifteen hours"],[20,"Twenty hours"]]},day:{unit:"day",price:50000,fine:10000,opts:[[1,"One day"],[3,"Three days"],[5,"Five days"],[7,"Seven days"]]},week:{unit:"weeks",price:250000,fine:25000,opts:[[1,"One week"],[2,"Two weeks"],[3,"Three weeks"],[4,"Four weeks"]]},month:{unit:"month",price:700000,fine:50000,opts:[[1,"One month"],[2,"Two months"],[3,"Three months"],[6,"Six months"]]}};
let cat="hour",duration=5,label="Five hours";document.getElementById("product").textContent=localStorage.getItem("kazeSelectedItem")||"PlayStation V";
function category(c,el){cat=c;document.querySelectorAll(".tab").forEach(x=>x.classList.remove("active"));el.classList.add("active");renderOptions();const o=rates[c].opts[0];choose(o[0],o[1]);}
function renderOptions(){const box=document.getElementById("options");box.innerHTML=rates[cat].opts.map(o=>`<button class="opt" onclick="choose(${o[0]},'${o[1]}',this)">${o[1]}</button>`).join("")+`<button class="opt" onclick="showManual()">Select manual loan duration...</button>`}
function choose(v,l,el){duration=v;label=l;document.querySelectorAll(".opt").forEach(x=>x.classList.remove("selected"));if(el)el.classList.add("selected");document.getElementById("manual").classList.remove("show");update()}
function showManual(){document.querySelectorAll(".opt").forEach(x=>x.classList.remove("selected"));document.getElementById("manual").classList.add("show");document.getElementById("manualInput").focus()}
function manualUpdate(){const v=Number(document.getElementById("manualInput").value);if(v>0){duration=v;label=v+" "+rates[cat].unit;update()}}
function update(){const r=rates[cat];document.getElementById("selected").textContent=label;document.getElementById("unit").textContent=money(r.price)+" per "+r.unit;document.getElementById("total").textContent="Total : "+money(r.price*duration);document.getElementById("fine").textContent="A fine of "+money(r.fine)+" per "+r.unit+" if you are late returning borrowed items"}
function startBorrow(){const r=rates[cat],total=r.price*duration;if(getBalance()<total){alert("Saldo tidak cukup. Silakan Top Up terlebih dahulu.");return}setBalance(getBalance()-total);addTransaction("Borrow - "+document.getElementById("product").textContent,total,label);alert("Peminjaman berhasil. Saldo terpotong "+money(total));go("dashboard.php")}
renderOptions();choose(5,"Five hours",document.querySelectorAll(".opt")[1]);
</script>
</body>
</html>
