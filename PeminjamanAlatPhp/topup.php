<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Kaze - Top Up</title>
<link rel="stylesheet" href="css/style.css">
<style>
.topup-page{margin:15px 1.7% 30px;border:3px solid #000;border-radius:22px;min-height:650px;padding:32px;background:#fff}
.topup-title{font-size:48px;font-weight:700;margin-bottom:25px}
.topup-form{max-width:500px;display:flex;flex-direction:column;gap:20px}
.field-group{display:flex;flex-direction:column;gap:8px}
.field-group label{font-size:24px;font-weight:700}
.field-group input{height:65px;border:3px solid #000;border-radius:18px;padding:0 18px;font-size:24px}
.btn-topup{height:70px;background:#000;color:#fff;border:0;border-radius:20px;font-size:26px;font-weight:700;cursor:pointer;margin-top:10px}
.btn-topup:hover{opacity:0.9}
@media(max-width:650px){
 .topup-page{margin:10px;padding:18px;border-radius:16px}
 .topup-title{font-size:36px}
 .field-group label{font-size:20px}
 .field-group input{height:55px;font-size:20px}
 .btn-topup{height:60px;font-size:22px}
}
</style>
</head>
<body>
<header class="header">
  <div class="profile" onclick="go('profile.php')" role="button" tabindex="0" title="Open Profile">
    <div class="logo">K</div>
    <div><div class="name" id="headerName">Kaze</div><div class="user-id" id="headerId">061108</div></div>
  </div>
  <button class="back" onclick="go('dashboard.php')">Back</button>
</header>

<main class="topup-page">
  <h1 class="topup-title">Top Up Balance</h1>
  <form class="topup-form" onsubmit="processTopup(event)">
    <div class="field-group">
      <label for="topupAmount">Nominal (Rp)</label>
      <input type="number" id="topupAmount" min="10000" placeholder="Contoh: 100000" required>
    </div>
    <button type="submit" class="btn-topup">Top Up Now</button>
  </form>
</main>

<script src="js/app.js"></script>
<script>
const settingsProfile=getProfile();
document.getElementById("headerName").textContent=settingsProfile.name;
document.getElementById("headerId").textContent=settingsProfile.id;

function processTopup(e){
  e.preventDefault();
  const amount = Number(document.getElementById('topupAmount').value);
  if(!amount || amount <= 0) return;
  setBalance(getBalance() + amount);
  addTransaction('Top Up Saldo', amount, 'Success');
  alert('Top Up sebesar ' + money(amount) + ' berhasil!');
  go('dashboard.php');
}
applyTheme();
</script>
</body>
</html>
