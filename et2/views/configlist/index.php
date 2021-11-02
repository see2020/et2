
<h1>Формирование ссылок и настройки системы</h1>

<p>вызвать базовый метод (эта страница)</p>
<p><a href="/et2/configlist/">Controller_Configlist::index() - /et2/configlist/</a></p>
<p><a href="/et2/?route=configlist">Controller_Configlist::index() - /et2/?route=configlist</a></p>
<p>&nbsp;</p>
<p>вызвать не базовый метод</p>
<p><a href="/et2/configlist/tst/">Controller_Configlist::tst() - /et2/configlist/tst/</a></p>
<p><a href="/et2/?route=configlist/tst">Controller_Configlist::tst() - /et2/?route=configlist/tst</a></p>


<p><a href="/et2/configlist/tst1/">Controller_Configlist::tst1()</a> - $this->template->view('tst1');</p>

<h2>Список настроек</h2>
<pre>
<?php print_r($configlist); ?>
</pre>



