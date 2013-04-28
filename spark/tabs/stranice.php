<?php
$PART->content = HTML();

function HTML(){
	return '
	<form action="" method="post">
    <div id="tabs">
        <ul>
	        <li><a href="#tabs-1">LANG1</a></li>
	        <li><a href="#tabs-2">LANG2</a></li>
	        <li><a href="#tabs-3">LANG3</a></li>
        </ul>
        <div id="tabs-1">
            <p>
                <label for="editor1">
                Naslov:
                </label>
                <input type="text" placeholder="Naslov" size="40">
            </p>
            <p>
                <label for="editor1">
                Editor 1:
                </label>
                <textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10"></textarea>
            </p>
        </div>
        <div id="tabs-2">
            <p>
                <label for="editor1">
                Naslov:
                </label>
                <input type="text" placeholder="Naslov" size="40">
            </p>
            <p>
                <label for="editor1">
                Editor 2:
                </label>
                <textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10"></textarea>
            </p>
        </div>
        <div id="tabs-3">
            <p>
                <label for="editor1">
                Naslov:
                </label>
                <input type="text" placeholder="Naslov" size="40">
            </p>
            <p>
                <label for="editor1">
                Editor 3:
                </label>
                <textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10"></textarea>
            </p>
        </div>
    </div>            
        <p>
            <button class="btn btn-primary" type="submit">Spremi</button>
            <button class="btn" type="button">Odustani</button>
        </p>
	</form>';
}