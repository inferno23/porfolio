<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Home extends Model
{
    use HasFactory;



    public function getAboutObjetivos()
    {
    	return DB::table('about')->where('is_active',1)->where('seccion',5)->first();
    }

       public function getHeaderObjetivos()
    {
    	return DB::table('headers')->where('is_active',1)->where('seccion',5)->first();
    }
    public function getFooterObjetivos()
    {
        return DB::table('footers')->where('is_active',1)->where('seccion',5)->first();
    }
       
    public function getAboutMision()
    {
    	return DB::table('about')->where('is_active',1)->where('seccion',4)->first();
    }

       public function getHeaderMision()
    {
    	return DB::table('headers')->where('is_active',1)->where('seccion',4)->first();
    }
    public function getFooterMision()
    {
        return DB::table('footers')->where('is_active',1)->where('seccion',4)->first();
    }
       

   public function getAboutInstitucional()
    {
    	return DB::table('about')->where('is_active',1)->where('seccion',3)->first();
    }

       public function getHeaderInstitucional()
    {
    	return DB::table('headers')->where('is_active',1)->where('seccion',3)->first();
    }
    public function getFooterInstitucional()
    {
        return DB::table('footers')->where('is_active',1)->where('seccion',3)->first();
    }
       


     public function getCursos()
    {
    	return DB::table('cursos')->where('activo',1)->get();
    }
      public function getHeaderCursos()
    {
    	return DB::table('headers')->where('is_active',1)->where('seccion',2)->first();
    }
    public function getFooterCursos()
    {
        return DB::table('footers')->where('is_active',1)->where('seccion',2)->first();
    }

    public function getNovedades()
    {
    	return DB::table('novedades')->where('activo',1)->get();
    }
      public function getHeaderNovedad()
    {
    	return DB::table('headers')->where('is_active',1)->where('seccion',1)->first();
    }
    public function getFooterNovedad()
     {
                return DB::table('footers')->where('is_active',1)->where('seccion',1)->first();
     }

    public function getHeader()
    {
    	return DB::table('headers')->where('is_active',1)->first();
    }

    public function getAbout()
    {
    	return DB::table('about')->where('is_active',1)->first();
    }

    public function getFooter()
    {
    	return DB::table('footers')->where('is_active',1)->first();
    }

    public function getSkill()
    {
    	return DB::table('skills')->get();
    }

    public function getPortfolio()
    {
    	return DB::table('portfolio')->get();
    }
}
