<div style="background-color:white; margin-top:-20px; width:100%; height:750px;">
<hr style=" border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);">
<form enctype="multipart/form-data"  class="form-horizontal" role="form" method="post" action="/Admin/checkarticle" >
        <div class="form-group">
              <div class="col-md-11">
              	<h3><p class="text-center">Заголовок:</p></h3>
                <input style="margin:auto 120px; float:right;" type="text" name="header" class="form-control" id="inputheader" placeholder="Заголовок">
              </div>
            </div>
            
            <div class="form-group">
            	<div class="col-md-11">
			  	<h3><p class="text-center">Выберите категорию:</p></h3>
			  <select style="margin:auto 120px; float:right;" class="form-control" name="category" id="sel1">
			  <?php 
			  	$sql=mysqli_query($db, "SELECT * FROM categories");
			    while ($result=mysqli_fetch_array($sql))
			    {
	              echo '<option>'.$result['Name'].'</option>';	
           		}
			  ?>
			  </select>
			  </div>
			</div>
			
			
            <div style="padding-top:40px;" class="form-group" >
            	 <textarea  style="resize:none;" name="article" id="editor1" rows="10" cols="80">
                
	            </textarea>
	            <script>     
	                CKEDITOR.replace( 'editor1' );
	            </script> 
		        <div style="margin-left:320px; margin-top:20px;" class="form-group">
		                <button type="submit" class="btn btn-primary">Опубликовать</button>
		        </div>
       	 </div>
</form>
</div>
           
