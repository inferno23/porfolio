<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Home;

class HomeController extends Controller
{
	protected $home;

	public function __construct()
	{
		$this->home = new Home;
	}



	public function ver( $id)
    {
		$obra = $this->home->getObraById($id);

        return view('home.obra',[
			'obra' => $obra,
			'getHeader' => $this->home->getHeaderObras(),
    		
    		'getFooter' => $this->home->getFooterObras(),
		
		]);
    }



    public function index()
    {
    	return view('home.index',[
    		'getHeader' => $this->home->getHeader(),
    		'getAbout' 	=> $this->home->getAbout(),
    		'getFooter' => $this->home->getFooter(),
    		'getSkill' 	=> $this->home->getSkill(),
    		'getPortfolio' 	=> $this->home->getPortfolio(), 
    	]);
    }




	public function obras()
    {
    	return view('home.obras',[
    		'getHeader' => $this->home->getHeaderObras(),
    		
    		'getFooter' => $this->home->getFooterObras(),
    		'getCursos'  	=> $this->home->getObras(),
    	]);
    }

	public function fotos()
    {
    	return view('home.fotos',[
    		'getHeader' => $this->home->getHeaderFotos(),
    		
    		'getFooter' => $this->home->getFooterFotos(),
    		'getCursos'  	=> $this->home->getFotos(),
    	]);
    }

	public function novedades()
    {
    	return view('home.novedades',[
    		'getHeader' => $this->home->getHeaderNovedad(),
    		'getAbout' 	=> $this->home->getAbout(),
    		'getFooter' => $this->home->getFooter(),
    		'getNovedades' 	=> $this->home->getNovedades(),
    	]);
    }

	public function cursos()
    {
    	return view('home.cursos',[
    		'getHeader' => $this->home->getHeaderCursos(),
    		'getAbout' 	=> $this->home->getAbout(),
    		'getFooter' => $this->home->getFooterCursos(),
    		'getPortfolio' 	=> $this->home->getPortfolio(), 
    		'getCursos' 	=> $this->home->getCursos(),
    	]);
    }

	public function institucional()
    {
    	return view('home.institucional',[
    		'getHeader' => $this->home->getHeaderInstitucional(),
    		'getAbout' 	=> $this->home->getAboutInstitucional(),
    		'getFooter' => $this->home->getFooterInstitucional(),
    		
    	]);
    }


	public function objetivos()
    {

		
    	return view('home.objetivos',[
    		'getHeader' => $this->home->getHeaderObjetivos(),
    		'getAbout' 	=> $this->home->getAboutObjetivos(),
    		'getFooter' => $this->home->getFooterObjetivos(),
    		
    	]);
    }
	public function mision()
    {
		
    	return view('home.mision',[
    		'getHeader' => $this->home->getHeaderMision(),
    		'getAbout' 	=> $this->home->getAboutMision(),
			'getDetalle' 	=> $this->home->getDetalleMision(),
    		'getFooter' => $this->home->getFooterMision(),
    		
    	]);
    }
}
