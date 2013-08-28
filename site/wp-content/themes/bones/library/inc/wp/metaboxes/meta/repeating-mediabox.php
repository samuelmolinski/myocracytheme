<h4>Slides</h4>
 
<a style="float:right; margin:0 10px;" href="#" class="dodelete-slide button">Remove All</a>
 
<p>Add Slides to the Search form.</p>
 
<?php while($mb->have_fields_and_multi('slide')): ?>
<?php $mb->the_group_open(); ?>
    <hr/>
 
    <?php $mb->the_field('title'); ?>
    <label>Title and Content</label>
    <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
     
    <?php $mb->the_field('content'); ?>
    <p><textarea name="<?php $mb->the_name(); ?>" rows="6"><?php $mb->the_value(); ?></textarea></p>

    <?php $mb->the_field('slideType'); ?>
    <p><strong>Slide Type:</strong>
        <ul class="style-none">
        <li><input type="radio" name="<?php $mb->the_name(); ?>" value="statement"<?php echo $mb->is_value('statement')?' checked="checked"':''; ?>/> Statement (i.e. intro) </li>
        <li><input type="radio" name="<?php $mb->the_name(); ?>" value="choice"<?php echo $mb->is_value('choice')?' checked="checked"':''; ?>/> Choice (i.e. questions) </li>
        <li><input type="radio" name="<?php $mb->the_name(); ?>" value="process"<?php echo $mb->is_value('process')?' checked="checked"':''; ?>/> Process (i.e. see results) </li>
        <li><input type="radio" name="<?php $mb->the_name(); ?>" value="result"<?php echo $mb->is_value('result')?' checked="checked"':''; ?>/> Result </li>
        </ul>
        <br/><a href="#" class="dodelete button">Remove Slide</a>
    </p>
 
<?php $mb->the_group_close(); ?>
<?php endwhile; ?>
 
<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-slide button">Add Slide</a></p>