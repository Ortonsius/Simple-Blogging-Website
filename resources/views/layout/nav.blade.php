<?php

session_start();

?>
<div class="nav">
    <div class="top">
        <form method="GET" action="/">
            <input type="text" name="q" placeholder="Search ...">
            <button>Search</button>
        </form>
        <div class="me">
            <?php if(isset($_SESSION["name"])): ?>
                <a href="/logout">{{ $_SESSION["name"] }}</a>
            <?php else: ?>
                <a href="/login">Login</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="bottom">
        <a href="/?c=sport">sport</a>
        <a href="/?c=fashion">fashion</a>
        <a href="/?c=economy">economy</a>
        <a href="/?c=politic">politic</a>
        <a href="/?c=food">food</a>
        <a href="/?c=health">health</a>
        <a href="/?c=hot">hot</a>
    </div>
</div>