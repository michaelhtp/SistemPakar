<?php
function KodeOtomatis($conn, $tabel, $id, $inisial, $index, $panjang)
{
  $query = "SELECT max($id) as max_id FROM `$tabel` WHERE $id LIKE '$inisial%'";
  $result = $conn->query($query);
  if (!$result) die("Query error: " . $conn->error);
  $data = $result->fetch_array();
  $id_max = $data['max_id'];

  if ($index == '' && $panjang == '') {
    $no_urut = (int) $id_max;
  } elseif ($index != '' && $panjang == '') {
    $no_urut = (int) substr($id_max, $index);
  } else {
    $no_urut = (int) substr($id_max, $index, $panjang);
  }

  $no_urut += 1;

  if ($index == '' && $panjang == '') {
    return $no_urut;
  } elseif ($index != '' && $panjang == '') {
    return $inisial . $no_urut;
  } else {
    return $inisial . sprintf("%0{$panjang}s", $no_urut);
  }
}

function DataArray($mysqli, $qry)
{
  $result = $mysqli->query($qry);
  if (!$result) die("Query error: " . $mysqli->error);
  return ($result->num_rows > 0) ? $result : "";
}

function SingleData($conn, $kolom, $table)
{
  $result = $conn->query("SELECT $kolom FROM $table");
  if (!$result) die("Query error: " . $conn->error);
  $row = $result->fetch_array();
  return $row[0];
}

function ArrayData($conn, $table, $kondisi)
{
  $result = $conn->query("SELECT * FROM $table WHERE $kondisi");
  if (!$result) die("Query error: " . $conn->error);
  return $result->fetch_assoc();
}

function JumlahData($conn, $table)
{
  $result = $conn->query("SELECT * FROM $table");
  if (!$result) die("Query error: " . $conn->error);
  return $result;
}

function lastinsert($conn, $qry)
{
  $result = $conn->query($qry);
  if (!$result) die("Query error: " . $conn->error);
  $row = $result->fetch_array();
  return $row[0];
}

function CekExist($conn, $qry)
{
  $result = $conn->query($qry);
  if (!$result) die("Query error: " . $conn->error);
  return $result->num_rows > 0;
}

function caridata($conn, $qry)
{
  $result = $conn->query($qry);
  if (!$result) die("Query error: " . $conn->error);
  $row = $result->fetch_array();
  return $row[0];
}
