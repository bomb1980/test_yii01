<?php
class DgacontentController extends Controller{
    public function actionRenderpdf()
	{
        $this->renderPartial('/site/searchpages/renderpdf');
       
    }
}

?>