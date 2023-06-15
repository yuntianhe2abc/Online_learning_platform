<?php 
if(isset($course_comments)){
    foreach($course_comments as $n)
		{
			?>
            <div class="panel panel-default">
                <div class="panel-heading">By <b><?php echo $n->comment_sender_name; ?></b> on <i><?php echo $n->date; ?></i>
                <?php 
                $count=0;
                $result = "";
                $rate=0;
                $rate=intval($n->rate);
                for($i = 1; $i <= 5; $i++){
     
                    if($rate > $count){
                        $result .= "<span>&#x2605</span>";
                    } else {
                        $result .= "<span>&#x2606</span>";
                    }
                    $count++;}
                    
                 ?>
                 <p>Course Rating : <?php echo $result?></p>
                </div>
                <div class="panel-body"><?php echo $n->comment; ?></div>
            </div>
			</br></br>
           
			<?php
		}
    }
?>