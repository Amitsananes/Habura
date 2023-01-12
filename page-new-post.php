
<!DOCTYPE html>
<html lang="en">
<head>
    <?php acf_form_head(); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php  get_header(); ?>
    

<?php  

    acf_form(array(
		'post_id' => 'new_post',
        'field_groups' => [975]
	)); 
    
?>
<?php get_footer(); ?>

</body>
</html>





