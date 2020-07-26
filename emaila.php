<?php
include('libs.php');
$mail= new mailer();

if(isset($_POST['send'])){
	if($_POST['name']!=''){
		if($_POST['from']!=''){
			if($_POST['sub']!=''){
				if($_POST['reply']!=''){
					if($_POST['email']!=''){
					    if($_POST['heading']!=''){
						    if($_POST['message']!=''){
	$f = $_FILES['img'];
	if ($f['size'] <= 0) { $pat = ''; $dburl = '';} else {
	$file = $_FILES['img'];
	$type = array('jpg','png','jpng','pdf','docx','doc');
	$get = explode('.', $file['name']);
	$pick = strtolower(end($get));
	if (in_array($pick, $type)) {
	$path = LOCALPAT.'file/';
	$sample = $path.date('Ymdhis').'.'.$pick;
	$dburl = str_replace(LOCALPAT,SERVERPAT,$sample);
	$move = move_uploaded_file($_FILES['img']['tmp_name'], $sample);
            } else {$er = 'File supported format jpg, jpng, png, pdf, docx,or doc only';}
        }
        try{
$go=$mail->eMailer($_POST['name'],$_POST['from'],$_POST['sub'],$_POST['reply'],$_POST['email'],$_POST['heading'],$_POST['message'],$sample);
    }catch(Exception $e){$er= $e->getMessage();}
						    }else{$er='Compose field is required';}
					    }else{$er='Letter Heading is required';}
					}else{$er='email address is required';}
				}else{$er='reply to is required';}
			}else{$er='Subject is required';}
		}else{$er='from is required';}
	}else{$er='Sender Name is required';}
}





 ?>


<!DOCTYPE html>
<html>
<head>
<title><?php echo $title; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="pngwave.png" rel="Shortcut Icon" />
<style type="text/css">
.pushout{
	margin-top:5px; 
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  padding:20px;
  /*On Hover*/
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
.card-header{
	padding:8px 21px;
	font-size:20px;
	font-weight:bolder;
	margin-bottom:1px;
	text-align:center;
}
input[type='text'] {
  padding: 6px 15px;
  box-sizing: border-box;
  border-radius:0 !important; 
  border: 1px solid #ccc !important;
}

textarea {
  padding: 6px 15px;
  border: 1px solid #ccc !important;
  border-radius: 0px !important;
  resize: none !important;
}
.alert{
	padding:3px 10px;
	margin-bottom:1px;
	border-radius:0px;
	font-weight:bold;
	text-transform:uppercase;
	text-align:center;
	font-size:11px;
}
.btn{
	border-radius:0px;
	padding:5px 20px;
	font-weight:bolder;
}
</style>
</head>

<body>

<div class="container">
<div class="row">	
<div class="col-md-6 col-md-offset-3 pushout">
<div class="card">
<div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> <?php echo $title; ?></div>
<div class="card-body">
<?php if(isset($_POST['send']))if($er): ?>
<div class="alert alert-danger text-white"><?php echo $er; ?></div>
<?php endif; ?>
<?php if(isset($_POST['send']))if($go): ?>
<div class="alert alert-success text-white"><i class="fa fa-check-circle"></i> <?php echo 'Email(s) Sent!'; ?></div>
<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="<?php echo SERVERPAT; ?>";},1500);});</script>';} 
<?php endif; ?>
<form method="POST" action="" name="form1" enctype="multipart/form-data">
<div class="form-group">
<div class="row">
<div class="col-md-6">	
<label for="name"><i class="fa fa-user"></i> Name:</label>
<input type="text" class="form-control" name="name" placeholder="Enter name" value="<?php if(isset($_POST['send'])){echo $_POST['name'];} ?>">
</div>
<div class="col-md-6">	
<label for="name"><i class="fa fa-user-circle"></i> From:</label>
<input type="text" class="form-control" name="from" placeholder="Enter From" value="<?php if(isset($_POST['send'])){echo $_POST['from'];} ?>">
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-md-6">
<label for="name"><i class="fa fa-anchor"></i> Subject:</label>
<input type="text" class="form-control" name="sub" placeholder="Enter Subject" value="<?php if(isset($_POST['send'])){echo $_POST['sub'];} ?>">
</div>
<div class="col-md-6">
<label for="name"><i class="fa fa-envelope"></i> Reply to:</label>
<input type="text" class="form-control" name="reply" placeholder="Enter Reply to" value="<?php if(isset($_POST['send'])){echo $_POST['reply'];} ?>">
</div>
</div>
</div>

<div class="form-group">
<label for="email"><i class="fa fa-at"></i> Email address: </label>
<textarea class="form-control" name="email" rows="3" placeholder="Enter Email Address"><?php if(isset($_POST['send'])){echo $_POST['email'];} ?></textarea>
<small id="emailHelp" class="form-text text-danger text-center">
Single & Multiple mailer system. If multiple arrange emails in rows</small>
</div>

<div class="form-group">
<label for="name"><i class="fa fa-th"></i> Letter Heading:</label>
<input type="text" class="form-control" name="heading" placeholder="Enter Letter Heading" value="<?php if(isset($_POST['send'])){echo $_POST['heading'];} ?>">
</div>

<div class="form-group">
<label for="message">Compose Message .. <i class="fa fa-pencil"></i> </label>
<textarea class="form-control" name="message" rows="6" placeholder="Enter Message (Message can contain html characters)"><?php if(isset($_POST['send'])){echo $_POST['message'];} ?></textarea>
</div>

<div class="form-group">
<label for="message"><i class="fa fa-file"></i> Attachment: </label>
    <input type="file" name="img" title="Add Attachment">
</div>

<div class="mx-auto">
<button type="submit" name="send" class="btn btn-primary">
	<i class="fa fa-send"></i> Send Now</button>
<button type="reset" name="reset" class="btn btn-danger pull-right">
	<i class="fa fa-trash"></i> Clear</button></div>
</div>
</form>
</div>	
</div>
</div>	
</div>
</div>

<!-- Container -->

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</html>