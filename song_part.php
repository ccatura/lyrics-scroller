<?php


?>

<div id='create-song-all-parts-contatiner'>
    <div class='create-song-part-outer' id='song-part-template' type='song-part'>
        <div class="create-song-part-header">
            <div class="create-song-part-label">
                Part 
                <input type='text' part_id='song-part-label' value='Verse' /> 
                <div class='hints-container'>
                <span class='material-symbols-outlined fake-link' id='song-part-hints'>help</span>
                    <div class='hints'>
                        <strong>COMMON OPTIONS</strong>:<br>
                        Verse, Lift, Chorus, Refrain, Bridge<br><br>
                        Use 'Hidden' to hide the label.<br><br>
                        Use 'Comment' for italicized label.
                    </div>
                </div>
            </div>
            <div class="create-song-part-buttons">
                <span class='material-symbols-outlined horizontal-button fake-link'>arrow_upward</span>
                <span class='material-symbols-outlined horizontal-button fake-link'>arrow_downward</span>
                <span class='material-symbols-outlined horizontal-button fake-link' onclick='deleteSongPart(this)'>close</span>
            </div>
        </div>
        <div class="create-song-part-content">
            <textarea class='create-song-part-lyrics' name="" id="" cols="30" rows="10" value='Type lyrics here' part_id='lyrics'></textarea>
        </div>
        <div class="create-song-part-actions">
            <input type="button" class='popup-button' value='Duplicate Part' onclick='duplicateSongPart(this);' />
            <input type="button" class='popup-button' value='Add Empty Part' onclick='addSongPart(this);' />
        </div> 
    </div>
</div>