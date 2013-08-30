<?php 

    $current_issues_cat = get_customTerms("current_issues_cat");

    /*
    [0] => stdClass Object
        (
            [term_id] => 30
            [name] => Civil Rights
            [slug] => civil-rights
            [term_group] => 0
            [term_taxonomy_id] => 30
            [taxonomy] => current_issues_cat
            [description] => 
            [parent] => 0
            [count] => 24
        )
    */
?>
<span class="h2">Slides</span> 
 
<a style="float:right; margin:0 10px;" href="#" class="dodelete-slide button">Remove All</a>
 
<p>Add Slides to the Search form.</p>
 
<?php while($mb->have_fields_and_multi('slide')): ?>
<?php $mb->the_group_open(); ?>
    <hr/>
    <span class="h3">Slide</span> 

    <?php $mb->the_field('slideType'); ?>
    <p><strong>Slide Type:</strong>
        <ul class="style-none slideType">
        <li><input type="radio" name="<?php $mb->the_name(); ?>" value="statement"<?php echo $mb->is_value('statement')?' checked="checked"':''; ?>/> Statement (i.e. intro) </li>
        <li><input type="radio" name="<?php $mb->the_name(); ?>" value="choice"<?php echo $mb->is_value('choice')?' checked="checked"':''; ?>/> Choice (i.e. questions) </li>
        <li><input type="radio" name="<?php $mb->the_name(); ?>" value="process"<?php echo $mb->is_value('process')?' checked="checked"':''; ?>/> Process (i.e. see results) </li>
        <li><input type="radio" name="<?php $mb->the_name(); ?>" value="result"<?php echo $mb->is_value('result')?' checked="checked"':''; ?>/> Result </li>
        </ul>
    </p>

    <?php $mb->the_field('title'); ?>
    <label>Title:</label>
    <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
     
    <label>Content:</label>
    <?php $mb->the_field('content'); ?>
    <p><textarea name="<?php $mb->the_name(); ?>" rows="6"><?php $mb->the_value(); ?></textarea></p>

    <label>Topic Code:</label>
    <p>Create new topics by creating a new catergory for Current Issues</p>
    <?php $mb->the_field('topic-code'); ?>    
    <select name="<?php $mb->the_name(); ?>">
        <option value="">Select...</option>
    <?php     
        foreach ($current_issues_cat as $key => $cat) { ?>
            <option value="<?php echo $cat->term_id; ?>"<?php $mb->the_select_state($cat->term_id); ?>><?php echo $cat->name; ?></option>"
    <?php } ?>
    </select>
 
    <span class="h3">Labels</span> 
    <label>Button - Next:</label>
    <?php $mb->the_field('btn-next'); ?>
    <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $mb->get_the_value()? $mb->get_the_value(): 'Next'; ?>" /></p>

    <label>Button - Previous:</label>
    <?php $mb->the_field('btn-back'); ?>
    <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $mb->get_the_value()? $mb->get_the_value(): 'Back'; ?>" /></p>

    <label>Button - Confirm:</label>
    <?php $mb->the_field('btn-agree'); ?>
    <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $mb->get_the_value() ? $mb->get_the_value(): 'Agree'; ?>" /></p>

    <label>Button - Reject:</label>
    <?php $mb->the_field('btn-disagree'); ?>
    <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $mb->get_the_value() ? $mb->get_the_value(): 'Disagree'; ?>" /></p>

    <label>Button - Process:</label>
    <?php $mb->the_field('btn-process'); ?>
    <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $mb->get_the_value() ? $mb->get_the_value(): 'Results'; ?>" /></p>

    <label>Button - Skip:</label>
    <?php $mb->the_field('btn-skip'); ?>
    <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $mb->get_the_value() ? $mb->get_the_value(): 'Skip this question'; ?>" /></p>

    <br/><a href="#" class="dodelete button">Remove Slide</a>
<?php $mb->the_group_close(); ?>
<?php endwhile; ?>
 
<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-slide button">Add Slide</a></p>