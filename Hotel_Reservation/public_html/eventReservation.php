<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>DMN Hotel Receipt</title>

<style>

body{
    background:#f5f0e8;
    font-family:Georgia, serif;
    padding:40px;
}

.receipt{
    max-width:800px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 4px 12px rgba(0,0,0,0.15);
}

.receipt h1,
.receipt h2{
    text-align:center;
    color:#49372b;
}

.receipt table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

.receipt td{
    padding:12px;
    border-bottom:1px solid #ddd;
}

.alignright{
    text-align:right;
}

.total{
    font-weight:bold;
    font-size:18px;
}

.error-box{
    max-width:600px;
    margin:40px auto;
    padding:20px;
    text-align:center;
    background:#fdecea;
    border-left:6px solid red;
    border-radius:8px;
}

.print-btn{
    display:block;
    margin:30px auto;
    padding:12px 25px;
    border:none;
    background:#80634b;
    color:white;
    cursor:pointer;
    border-radius:6px;
}

.print-btn:hover{
    background:#49372b;
}

</style>

</head>
<body>

<?php








