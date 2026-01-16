<?php
// gallery_action.php
session_start();
require 'db.php'; // PDO $pdo
$action = $_POST['action'] ?? $_GET['action'] ?? '';

if($action === 'list'){
    $q = "%".$_GET['q']."%";
    $stmt = $pdo->prepare("SELECT * FROM gallery WHERE title LIKE ? OR caption LIKE ? ORDER BY created_at DESC");
    $stmt->execute([$q,$q]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

if($action === 'create'){
    // expects: title, caption, file upload 'image'
    if(!isset($_FILES['image'])) { echo json_encode(['error'=>'no file']); exit; }
    $title = $_POST['title'] ?? '';
    $caption = $_POST['caption'] ?? '';
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = uniqid('g_').'.'.$ext;
    $dest = __DIR__.'/uploads/gallery/'.$filename;
    if(!move_uploaded_file($_FILES['image']['tmp_name'], $dest)){
        echo json_encode(['error'=>'upload failed']); exit;
    }
    $stmt = $pdo->prepare("INSERT INTO gallery (title, filename, caption) VALUES (?,?,?)");
    $stmt->execute([$title,$filename,$caption]);
    echo json_encode(['success'=>true]);
    exit;
}

if($action === 'delete'){
    $id = intval($_POST['id']);
    $stmt = $pdo->prepare("SELECT filename FROM gallery WHERE id=?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row){
        @unlink(__DIR__.'/uploads/gallery/'.$row['filename']);
    }
    $stmt = $pdo->prepare("DELETE FROM gallery WHERE id=?");
    $stmt->execute([$id]);
    echo json_encode(['success'=>true]);
    exit;
}

if($action === 'update'){
    // similar to create but update fields; support optional file replace
    $id = intval($_POST['id']);
    $title = $_POST['title'] ?? '';
    $caption = $_POST['caption'] ?? '';
    if(isset($_FILES['image']) && $_FILES['image']['error']===0){
        // replace file
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('g_').'.'.$ext;
        $dest = __DIR__.'/uploads/gallery/'.$filename;
        if(move_uploaded_file($_FILES['image']['tmp_name'], $dest)){
            // remove old
            $stmt = $pdo->prepare("SELECT filename FROM gallery WHERE id=?");
            $stmt->execute([$id]);
            $old = $stmt->fetch(PDO::FETCH_ASSOC);
            if($old) @unlink(__DIR__.'/uploads/gallery/'.$old['filename']);
            $stmt = $pdo->prepare("UPDATE gallery SET title=?,caption=?,filename=? WHERE id=?");
            $stmt->execute([$title,$caption,$filename,$id]);
            echo json_encode(['success'=>true]); exit;
        } else { echo json_encode(['error'=>'upload failed']); exit; }
    } else {
        $stmt = $pdo->prepare("UPDATE gallery SET title=?,caption=? WHERE id=?");
        $stmt->execute([$title,$caption,$id]);
        echo json_encode(['success'=>true]); exit;
    }
}

echo json_encode(['error'=>'unknown action']);
