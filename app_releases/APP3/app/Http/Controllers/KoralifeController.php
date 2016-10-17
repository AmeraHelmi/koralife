<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Team;
use App\Models\Match;
use App\Models\Coach;
use App\Models\V_album;
use App\Models\Player_match;
use App\Models\Reserve_player;
use App\Models\Snew;
use App\Models\Expection;
use App\Models\Sponsor;
use App\Models\Player_historie;
use App\Models\Championship;
use App\Models\Team_championship;
use App\Models\G_album_photo;
use App\Models\G_album;
use App\Models\Referee;
use App\Models\Championship_sponsor;
use App\Models\Stadium;
use App\Models\Country;
use App\Models\Category;
use App\Models\Post;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\Pcomment;
use App\Models\Bcomment;
use App\Models\Member;
use App\Models\Team_player;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Carbon\Carbon;
use Input;
use Session;

class KoralifeController extends Controller
{

		public function __construct(Request $request)
	 	{
		if(strchr($request->url() ,'news') !== false){
			  $max_likes = Snew::max('likes');
				$get_record = Snew::where('likes',$max_likes)->first();
				$page="news";
		}
		else if(strchr($request->url() ,'vedios') !== false){
				$max_likes = V_album::max('like_count');
				$get_record = V_album::where('like_count',$max_likes)->first();
				$page="vedios";
		}
		else if(strchr($request->url() ,'posts') !== false){
				$max_likes = Post::max('likes');
				$get_record = Post::where('likes',$max_likes)->first();
				$page="posts";
		}
		else{
				$max_likes = Blog::max('likes');
				$get_record = Blog::where('likes',$max_likes)->first();
				$page="blogs";
		}

			$cats = Category::get();
			$tags = Tag::take(15)->orderby('id','desc')->get();
			$final_count = [];
			$i = 0;
			foreach ($cats as $cat) {
				$i++;
				$snews_cat   = Snew::where('cat_id',$cat->id)->count();
				$video_cat   = V_album::where('category_id',$cat->id)->count();
				$gallery_cat = G_album::where('category_id',$cat->id)->count();
				$post_cat    = Post::where('cat_id',$cat->id)->count();

				$final_count [$cat->id]= $snews_cat + $video_cat + $gallery_cat + $post_cat ;
			}
			view()->share('final_count',$final_count);
			view()->share('categories',$cats);
			view()->share('tags',$tags);
			view()->share('get_record',$get_record);
			view()->share('page',$page);
			view()->share('session', session('user_name'));
	}

	public function index()
	{
	//category section
		$cats = Category::get();

	//posts section
		$post=new Post;
				$posts=$post
                ->join('categories as cat','cat.id','=','posts.cat_id')
								->select(array(
									'posts.id as id',
									'posts.title as title',
									'posts.flag as flag',
									'posts.body as body',
									'posts.date as date',
									'posts.comments as comments',
									'cat.name as catname'
								))
								->take(8)->orderBy('id','desc')->get();

		//news slider section
		$new = new Snew;
				$slider_news = $new->take(4)->where('publish','YES')->orderBy('id','desc')->get();

		//today_new section
		$today_new = new Snew;
				$news = $new
									->join('categories as c','c.id','=','snews.cat_id')
									->select(array(
										 'snews.id as id',
										 'c.name as Cname',
										 'snews.title as title',
										 'snews.flag as flag',
										 'snews.likes as likes',
										 'snews.created_at as created_at',
										 'snews.additional_info as additional_info',
										 'snews.date as date'
										 ))
									->where('today_new','YES')->where('date',date('Y-m-d'))->first();

		//video section
		$v_album=new V_album;
				$vedios=$v_album->take(4)->orderBy('id','desc')->get();

	 //gallery section
	 $g_album=new G_album_photo;
	 			$photos=$g_album->take(4)->orderBy('id','desc')->get();

	//player histories اخر الانتقالات section
	$player_historie = new Player_historie();
				$players = $player_historie
			                ->join('players as p','p.id','=','player_histories.player_id')
											->join('teams as t1','t1.id','=','player_histories.from_team_id')
											->join('teams as t2','t2.id','=','player_histories.to_team_id')
											->select(array(
												'p.name as player_name',
												'p.id as player_id',
												'p.flag as flag',
												't1.name as team1_name',
												't2.name as team2_name',
												'player_histories.id as id',
												'player_histories.contract_type as contract_type',
												'player_histories.contract_total as contract_total',
												'player_histories.season_type as season_type',
												'player_histories.from_date as from_date'
											))
										->orderBy('id','desc')->get();
     $expects = new Expection();
		     $expections = $expects->orderBy('id','desc')->first();

				return view ('Front.index')
				->with('cats',$cats)
				->with('posts',$posts)
				->with('news',$news)
				->with('slider_news',$slider_news)
				->with('vedios',$vedios)
				->with('players',$players)
				->with('expections',$expections)
				->with('photos',$photos);
	}
//share_opinion
public function share_opinion(Request $request)
{
	$answer    = $request->ans;
	$quest_id  = $request->quest_id;
	$expects = Expection::find($quest_id);
		if ($answer == "ans1") {
				$expects->count1 = $expects->count1 + 1;
		}
		elseif ($answer == "ans2") {
				$expects->count2 = $expects->count2 + 1;
		}
		elseif ($answer == "ans3") {
				$expects->count3 = $expects->count3 + 1;
		}
		else{
				$expects->count4 = $expects->count4 + 1;
		}
		$expects->save();

		return response(array('msg' => 'Adding Successfull'), 200)
		->header('Content-Type', 'application/json');
}
	//blogs
	public function blogs()
	{
		$blogs=new Blog;
		$blogs=$blogs->take(9)->orderBy('id','desc')->get();
		return view ('Front.blog')
		->with('blogs',$blogs);
	}



//////////////////////////////////////////////////////////////////////////////////////
	//gallary
		//gallary
	public function gallary()
	{
				$g_album=new G_album_photo;
				$photos=$g_album->orderBy('id','desc')->get();
				$cat=new Category;
				$cats=$cat->orderBy('id','desc')->get();
				$count=$photos->count();
				if(sizeof($photos)>0)
				{
				$count=$photos->count();

				$first_objs=$photos[0];
				$fid=$first_objs->id;
				$second_objs=$g_album->where('id','<',$fid)->orderBy('id','desc')->take(4)->get();
				if(count($second_objs)>0)
				{
					// dd("first_id:".$fid."second_ids:".$second_objs);
					$sid=$second_objs[sizeof($second_objs) - 1]->id;
					$three_objs=$g_album->where('id','<',$sid)->orderBy('id','desc')->take(4)->get();
					if(count($three_objs)>0)
					{
							$th_id=$three_objs[sizeof($three_objs) - 1]->id;
							$forth_objs=$g_album->where('id','<',$th_id)->orderBy('id','desc')->first();
							$lastid=$th_id;
							if(count($forth_objs)>0)
							{
									$lastid=$forth_objs->id;
									return view ('Front.gallery')
															->with('first_objs',$first_objs)
															->with('second_objs',$second_objs)
															->with('three_objs',$three_objs)
															->with('forth_objs',$forth_objs)
															->with('imagescount ',$count)
															->with('cats',$cats)
															->with('status',"gallary")
															->with('msg',"images")
															->with('lastid',$lastid);
							}
							else
							{
										$lastid=$th_id;
										return view ('Front.gallery')
															->with('first_objs',$first_objs)
															->with('second_objs',$second_objs)
															->with('three_objs',$three_objs)
															->with('forth_objs',$forth_objs)
															->with('lastid',$lastid)
															->with('cats',$cats)
															->with('status',"gallary")
															->with('msg',"images")
															->with('imagescount',$count);
						  }
		      }
		      else
					{
							$lastid=$sid;
							return view ('Front.gallery')
													->with('first_objs',$first_objs)
													->with('second_objs',$second_objs)
													->with('three_objs',$three_objs)
													->with('lastid',$lastid)
													->with('cats',$cats)
													->with('status',"gallary")
													->with('msg',"images")
													->with('imagescount',$count);
					}
			}
			else
			{
				$lastid=$fid;
				return view ('Front.gallery')
										->with('first_objs',$first_objs)
										->with('lastid',$lastid)
										->with('cats',$cats)
										->with('status',"gallary")
										->with('msg',"images")
										->with('imagescount',$count);
		  }

		}
			else
			{
				return view ('Front.gallery')
										->with('status',"gallary")
										->with('cats',$cats)
										->with('msg',"لا توجد صور")
										->with('imagescount',$count)
										;
			}
	}
	public function testfilter_image($id)
	{
				$g_album=new G_album;
				$photos_albums=$g_album->where('category_id',$id)->orderBy('id','desc')->get();
				//  dd($photos_albums);
				$photos=[];
				$g_album_photo=new G_album_photo;
				foreach ($photos_albums as $album)
				{
						// dd($album->id);
						$photos_album=$g_album_photo->where('g_album_id',$album->id)->orderBy('id','desc')->get();
						$photos=$photos_album;
				}
				// dd($photos);
				// check if length of array
				$count=sizeof($photos);
				$cat=new Category;
				$cats=$cat->orderBy('id','desc')->get();
				if($count > 0)
				{
				$cat=new Category;
				$cats=$cat->orderBy('id','desc')->get();
				$first_objs=$photos[sizeof($photos) - 1];
				$fid=$first_objs->id;
				$second_objs=$g_album->where('id','>',$fid)->take(4)->get();
				if(count($second_objs)>0)
				{
							// dd("first_id:".$fid."second_ids:".$second_objs);
							$sid=$second_objs[sizeof($second_objs) - 1]->id;
							$three_objs=$g_album->where('id','>',$sid)->take(4)->get();
							if(count($three_objs)>0)
							{
								$th_id=$three_objs[sizeof($three_objs) - 1]->id;
								$forth_objs=$g_album->where('id','>',$th_id)->first();
								$lastid=$th_id;
								if(count($forth_objs)>0)
								{
										$lastid=$forth_objs->id;
										return view ('Front.gallery')
																->with('first_objs',$first_objs)
																->with('second_objs',$second_objs)
																->with('three_objs',$three_objs)
																->with('forth_objs',$forth_objs)
																->with('imagescount',$count)
																->with('cats',$cats)
																->with('msg',"images")
																->with('status',"filter")
																->with('lastid',$lastid);
								}
								else
								{
										$lastid=$th_id;
										return view ('Front.gallery')
																->with('first_objs',$first_objs)
																->with('second_objs',$second_objs)
																->with('three_objs',$three_objs)
																->with('forth_objs',$forth_objs)
																->with('lastid',$lastid)
																->with('cats',$cats)
																->with('msg',"images")
																->with('status',"filter")
																->with('imagescount',$count);
								}
						}
						else
						{
								$lastid=$sid;
								return view ('Front.gallery')
													->with('first_objs',$first_objs)
													->with('second_objs',$second_objs)
													->with('three_objs',$three_objs)
													->with('lastid',$lastid)
													->with('cats',$cats)
													->with('msg',"images")
													->with('status',"filter")
													->with('imagescount',$count);
					   }
		     }
		     else
				 {
			       $lastid=$fid;
			       return view ('Front.gallery')
											->with('first_objs',$first_objs)
											->with('lastid',$lastid)
											->with('cats',$cats)
											->with('status',"filter")
											->with('msg',"images")
											->with('imagescount',$count);
								}
				 }
				 else {
					 return view ('Front.gallery')
					 					->with('status',"filter")
										->with('cats',$cats)
										->with('msg',"لا توجد صور")
										->with('imagescount',$count);				 }
	}

//////////////////////////////////////////////////////////////////////////////////////
	//post
	public function post()
	{
		$post=new Post;
		$posts=$post->take(9)->orderBy('id','desc')->get();
		return view ('Front.post')
		->with('posts',$posts);
	}
	//postdetails
	public function post_details(Pcomment $pcomment , $id)
	{
		$post = new Post();
		$p_detail = $post
		             ->join('categories as c','c.id','=','posts.cat_id')
		             ->select(array('posts.id as id',
		             	            'c.name as Cname',
		             	            'posts.title as title',
		             	            'posts.flag as flag',
		             	            'posts.body as body',
		             	            'posts.date as date',
		             	            'posts.author as author'))
		             ->where('posts.id',$id)->get();
 $posts_meta = $post
            ->join('tags as t','t.page_id','=','posts.id')
 					  ->select(array(
							't.id as meta_id',
 							't.meta_words as meta_words'
 											))
 									   ->where('posts.id',$id)->where('url_word','posts')->get();

		session(['postid' => $id]);
		$url = 'posts';
		$previous_post_id = $post->where('id','<',$id)->first();
		$next_post_id     = $post->where('id','>',$id)->first();

		$num_comments = Pcomment::where('post_id',$id)->count();


		return view ('Front.post-details')
		->with('p_details',$p_detail)
		->with('posts',$url)
		->with('posts_meta',$posts_meta)
		->with('post_id',$id)
		->with('postid',session('postid'))
		->with('previous_post_id',$previous_post_id)
		->with('next_post_id',$next_post_id)
		->with('num_comments',$num_comments);
	}


	//blog-details== 3alnasya



	//blog-details
	public function blogs_details($id)
	{
		$b_detail = new Blog();
		$b_details = $b_detail
		             ->join('categories as c','c.id','=','blogs.cat_id')
		             ->select(array(
									            'blogs.id as id',
								 	            'c.name as Cname',
		             	            'blogs.title as title',
		             	            'blogs.flag as flag',
		             	            'blogs.body as body',
		             	            'blogs.date as date',
		             	            'blogs.vedio_url as vedio_url',
		             	            'blogs.likes as likes',
		             	            'blogs.author as author'))
		             ->where('blogs.id',$id)->get();

$blogs_meta = $b_detail
           ->join('tags as t','t.page_id','=','blogs.id')
					 ->select(array(
						 't.id as meta_id',
						 't.meta_words as meta_words'
											))
									   ->where('blogs.id',$id)->where('url_word','blogs')->get();

	session(['blogid' => $id]);
	$url = 'blogs';
		$previous_blog_id = $b_detail->where('id','<',$id)->first();
		$next_blog_id     = $b_detail->where('id','>',$id)->first();
    $num_comments     = Bcomment::where('blog_id',$id)->count();
		return view ('Front.blog-details')
		->with('b_details',$b_details)
		->with('blogs',$url)
		->with('blogs_meta',$blogs_meta)
		->with('blogid',session('blogid'))
		->with('previous_blog_id',$previous_blog_id)
		->with('next_blog_id',$next_blog_id)
		->with('num_comments',$num_comments);
	}

//////////////////////////////////////////////////////////////////////////////////////
	//vedio
	public function vedio()
	{
		$v_album=new V_album;
		$vedios=$v_album->take(6)->orderBy('id','desc')->get();

		$cat=new Category;
		$cats=$cat->orderBy('id','desc')->get();

			return view ('Front.vedios')
			->with('vedios',$vedios)
			->with('cats',$cats);
	}
	public function testfilter_vedio(Request $request)
	{
		$cat_id= $request->cat_id;
		$v_album=new V_album;
		$vedios=$v_album->where('category_id',$cat_id)->orderBy('id','desc')->get();
    $output ='';
		if(count($vedios) > 0){
		foreach($vedios as $vedio){
		$output .= '
		<div class="box-body col-sm-4">
				<div class="bordered padding-all">
				<a class="details" href="vedios/'.$vedio->id.'">
					<figure title="">
					<h3 class="text-uppercase text-info">'.$vedio->title.'</h3>
					<div  class="vid-box">
						<i class="icofont icofont-ui-play"></i>
						<img class="img-responsive" alt="" src="images/uploads/'.$vedio->flag.'"> </div>
				</figure>
				</a>
				<div class="box-sub-info">
					<ul class="list-inline no-padding-right text-primary row">
						<li class="col-sm-4">
							<a class="btn btn-sm btn-default btn-block" href="#">
								<i class="icofont icofont-calendar"></i>'. $vedio->date.'
							</a>
						</li>
						<li class="col-sm-4">
							<a class="btn btn-sm btn-default btn-block" href="#">
								<i class="icofont icofont-eye-alt"></i>'.$vedio->view_count .'مشاهدة
							</a>
						</li>

						<li class="col-sm-4">
							<a class="btn btn-sm btn-default btn-block" href="#">
								<i class="icofont icofont-speech-comments"></i>'.$vedio->like_count.' اعجاب
							</a>
						</li>

					</ul>
				</div>
				</div>
				</div>';
}
		}
		echo $output;

	}

/////////////////////////filter photos home page	////////////////////
public function filter_photos_index(Request $request)
{
	$cat_id= $request->cat_id;
	$g_album=new G_album;
	$photos_albums=$g_album->where('category_id',$cat_id)->orderBy('id','desc')->get();
	$photos=[];
	$g_album_photo=new G_album_photo;
	$count = 0 ;
	foreach ($photos_albums as $album)
	{
			$photos_album=$g_album_photo->where('g_album_id',$album->id)->orderBy('id','desc')->get();
			$photos=$photos_album;
	}
	$output ='';
	if(count($photos) > 0){
	foreach($photos as $photo){
	$count++;
	$output .= '
	<div class="box-body col-sm-6">
		<figure class="gallery-box">
			<div class="box">
				<div class="slide"><img class="img-responsive" alt="'.$photo->alt.'" src="images/uploads/'.$photo->flag.'">
					<div class="overlay"></div>
					<div class="overlay-info"> <span class="details-action">
						<a href="images/uploads/'.$photo->flag.'" class="popup-img"
						><i class="action-icon icofont icofont-maximize"></i>
					</a></span>
						<div class="info text-center">
							<h4 class="text-uppercase">'.$photo->alt.'</h4>
						</div>
					</div>
				</div>
			</div>
		</figure>
	</div>';
	if($count == 4)
			break;
}
	}
	else{
			echo 'لا توج صور فى هذا الالبوم';
	}
	echo $output;

}

public function filter_today_new(Request $request)
{
	$cat_id= $request->cat_id;
	$new = new Snew;
	$today_new = $new
						->where('today_new','YES')->where('snews.cat_id',$cat_id)->where('date',date('Y-m-d'))->first();

	$output ='';
	$output .= '
	<div class="box-body">
		<a href="news/'.$today_new->id.'" >
			<div class="navy-gradient-overlay"></div>
			<img class="img-responsive" alt="" src="images/uploads/'.$today_new->flag.'"> </figure>
		</a>
		<div class="post-header post-header-today">
			<div class="labels text-gray"> <span><a href="#">
				<i class="icofont icofont-clock-time"></i> </a></span>منذ'.round((StrToTime ( date('Y-m-d H:i:s') )- StrToTime ( $today_new->created_at )) / ( 60 * 60 )).'ساعه<span><a href="#">
				<i class="icofont icofont-speech-comments"></i> <bdi>'.$today_new->likes.'</bdi> اعجاب</a></span></div>
			<h3 class="text-uppercase">
				 <a href="news/'.$today_new->id.'">'.$today_new->title.'</a></h3>
			<p class="box-desc">'.$today_new->additional_info.'</p>
		</div>
	</div>';
	echo $output;

}
/////////////////////////filter meta page//////////////////////
	public function testfilter_vedio_meta(Request $request)
	{
		$cat_id= $request->cat_id;
		$v_album=new V_album;
		$vedios=$v_album->where('category_id',$cat_id)->orderBy('id','desc')->get();
		$output ='';
		if(count($vedios) > 0){
		foreach($vedios as $vedio){
		$output .= '
		<div class="box-body col-sm-4">
				<div class="bordered padding-all">
				<a class="details" href="vedios/'.$vedio->id.'">
					<figure title="">
					<h3 class="text-uppercase text-info">'.$vedio->title.'</h3>
					<div  class="vid-box">
						<i class="icofont icofont-ui-play"></i>
						<img class="img-responsive" alt="" src="../../images/uploads/'.$vedio->flag.'"> </div>
				</figure>
				</a>
				<div class="box-sub-info">
					<ul class="list-inline no-padding-right text-primary row">
						<li class="col-sm-4">
							<a class="btn btn-sm btn-default btn-block" href="#">
								<i class="icofont icofont-calendar"></i>'. $vedio->date.'
							</a>
						</li>
						<li class="col-sm-4">
							<a class="btn btn-sm btn-default btn-block" href="#">
								<i class="icofont icofont-eye-alt"></i>'.$vedio->view_count .'مشاهدة
							</a>
						</li>

						<li class="col-sm-4">
							<a class="btn btn-sm btn-default btn-block" href="#">
								<i class="icofont icofont-speech-comments"></i>'.$vedio->like_count.' اعجاب
							</a>
						</li>

					</ul>
				</div>
				</div>
				</div>';
}
		}
		echo $output;

	}
//vedio_detail
	public function vedio_details($id)
	{
		$vedio = new V_album();
		$v_detail = $vedio
								 ->join('categories as c','c.id','=','v_albums.category_id')
								 ->select(array('v_albums.id as id',
															'c.name as Cname',
															'v_albums.title as title',
															'v_albums.flag as flag',
															'v_albums.vedio_url as vedio_url',
															'v_albums.like_count as like_count',
															'v_albums.description as description',
															'v_albums.created_at as date'))
								 ->where('v_albums.id',$id)->get();

		 $videos_meta = $vedio
		             ->join('tags as t','t.page_id','=','v_albums.id')
								 ->select(array(
									            't.id as meta_id',
															't.meta_words as meta_words'
														))
													->where('v_albums.id',$id)->where('url_word','videos')->get();

		session(['videoid' => $id]);
		$url = 'vedios';
		$cat=new Category;
		$cats=$cat->select(array('id','name'))->get();
		$previous_vedio_id = $vedio->where('id','<',$id)->first();
		$next_vedio_id     = $vedio->where('id','>',$id)->first();
		// increase num_views of this vedio
		$vedio_obj=V_album::find($id);
		$vedio_obj->view_count++;
		$vedio_obj->save();
		return view ('Front.video-details')
		->with('v_details',$v_detail)
		->with('cats',$cats)
		->with('vedios',$url)
		->with('videos_meta',$videos_meta)
		->with('videoid',session('videoid'))
		->with('previous_vedio_id',$previous_vedio_id)
		->with('next_vedio_id',$next_vedio_id);
	}

	//news
	public function getallnews()
	{
		$new = new Snew;
        $news = $new->take(10)->where('publish','YES')->orderBy('id','desc')->get();
		return view('Front.news')
		->with('news',$news);
	}
	//getnew
	public function getnew(Request $request , $new_id)
	{
			$new = new Snew;
	   	$news_detail = $new
		             ->join('categories as c','c.id','=','snews.cat_id')
		             ->select(array(
									            'snews.id as id',
		             	            'c.name as Cname',
		             	            'snews.title as title',
															'snews.flag as flag',
		             	            'snews.likes as likes',
		             	            'snews.additional_info as additional_info',
		             	            'snews.date as date'
														  ))
		             ->where('snews.id',$new_id)->first();

	 $news_meta = $new
	             ->join('tags as t','t.page_id','=','snews.id')
							 ->select(array(
								 't.id as meta_id',
								 't.meta_words as meta_words'
													))
												 ->where('snews.id',$new_id)->where('url_word','news')->get();

    session(['newid' => $new_id]);
		$previous_new_id = $new->where('id','<',$new_id)->first();
		$next_new_id     = $new->where('id','>',$new_id)->first();

$url = 'news';
	   return view('Front.news-details')
       ->with('newdetails',$news_detail)
			 ->with('news',$url)
			 ->with('news_meta',$news_meta)
       ->with('newid',session('newid'))
       ->with('previous_new_id',$previous_new_id)
	     ->with('next_new_id',$next_new_id);

	}
	////////////////////////////////////get metas/////////////////////////////////////////////////////
	public function gettopics(Request $request  , $meta)
	{
		if(strchr($request->url() ,'news') !== false){
			$tag = new Tag();
			$get_match_meta = $tag
			                  ->join('snews as sn','sn.id','=','tags.page_id')
												->select(array(
													'sn.id as id',
													'sn.flag as flag',
													'sn.date as date',
													'sn.likes as likes',
													'sn.additional_info as additional_info'
												))
												 ->where('tags.url_word','news')->where('tags.meta_words',$meta)->get();

			return view ('Front.news_meta')
			->with('get_match_meta',$get_match_meta);
		}
		elseif(strchr($request->url() ,'posts') !== false){
			$tag = new Tag();
			$get_match_meta = $tag
			                  ->join('posts as p','p.id','=','tags.page_id')
												->select(array(
													'p.id as id',
													'p.alt as alt',
													'p.flag as flag',
													'p.comments as comments',
													'p.date as date',
													'p.likes as likes',
													'p.body as body'
												))
												 ->where('tags.url_word','posts')->where('tags.meta_words',$meta)->get();
			return view ('Front.posts_meta')
			->with('get_match_meta',$get_match_meta);
		}
		elseif(strchr($request->url() ,'blogs') !== false){

			$tag = new Tag();
			$get_match_meta = $tag
												->join('blogs as b','b.id','=','tags.page_id')
												->select(array(
													'b.id as id',
													'b.title as title',
													'b.flag as flag',
													'b.date as date',
													'b.likes as likes',
													'b.author as author',
													'b.body as body'
												))
												 ->where('tags.url_word','blogs')->where('tags.meta_words',$meta)->get();
												 	$count=$get_match_meta->count();
			return view ('Front.blogs_meta')
			->with('get_match_meta',$get_match_meta);
		}
		else{
			$tag = new Tag();
			$get_match_meta = $tag
												->join('v_albums as v','v.id','=','tags.page_id')
												->select(array(
													'v.id as id',
													'v.title as title',
													'v.flag as flag',
													'v.date as date',
													'v.like_count as like_count',
													'v.description as description',
													'v.view_count as view_count'
												))
												 ->where('tags.url_word','videos')->where('tags.meta_words',$meta)->get();

												 $cat=new Category;
												 $cats=$cat->select(array('id','name'))->get();
			return view ('Front.videos_meta')
			->with('cats',$cats)
			->with('get_match_meta',$get_match_meta);
		}
	}
//////////////////////////////////////////////////////////////////////////////////////////////

	public function register_member(Request $request)
	{
	if(Input::hasFile('image'))
			{
		$file = Input::file('image');
		$filename=time();
		$file->move('images/uploads', $filename);
           $member = Member::create([
			'username'            => $request->username,
			'email'               => $request->email,
			'password'            => $request->password,
			'image'               => $filename
		]);
           session(['user_name' => $member->username]);
           $max_member_id = Member::max('id');
           session(['member_id' => $max_member_id]);

          			if($request->ajax()){
				return response(array('msg' => 'Adding Successfull'), 200)
									->header('Content-Type', 'application/json');
				}
			}
		else{
					return response(false, 200)
					->header('Content-Type', 'application/json');
			}
}

	public function login_member(Request $request)
	{
      $member = new Member();
      $members = $member
                 ->where('email'   ,$request->email)
                 ->where('password',$request->password)
                 ->first();



      if(count($members) > 0){
      	      session(['user_name' => $members->username]);
              session(['member_id' => $members->id]);
         	  return response(array('msg' => 'Adding Successfull'), 200)
									->header('Content-Type', 'application/json');
      }
      else{
              return response(false, 200)
					->header('Content-Type', 'application/json');
      }
	}

	public function logout_member()
	{
	Session::forget('user_name');
		return redirect()->back();
	}
////////////////////////////////////////////////////////////////////////////
//add post comment
  public function addcomment(Request $request)
	{
		$comment = new Pcomment();
		$comment->post_id   = session('postid');
		$comment->person_id = session('member_id');
		$comment->role      = 'member';
		$comment->comment   = $request->comment;
		$comment->date      = date('Y-m-d');
		$comment->save();

    $num_comments = Pcomment::where('post_id',session('postid'))->count();

		$post = Post::find(session('postid'));
		$post->comments = $post->comments + 	$num_comments;
		$post->save();

		if(count($comment) > 0){
			  return response(array('msg' => 'Adding Successfull'), 200)
									->header('Content-Type', 'application/json');
		}
       else{
              return response(false, 200)
					->header('Content-Type', 'application/json');
       }
	}

	//add blog comment
	public function addcomment_blog(Request $request)
	{
		$bcomment = new Bcomment();
		$bcomment->blog_id   = session('blogid');
		$bcomment->person_id = session('member_id');
		$bcomment->role      = 'member';
		$bcomment->comment   = $request->comment;
		$bcomment->date      = date('Y-m-d');
		$bcomment->save();

		if(count($bcomment) > 0){
				return response(array('msg' => 'Adding Successfull'), 200)
									->header('Content-Type', 'application/json');
		}
			 else{
							return response(false, 200)
					->header('Content-Type', 'application/json');
			 }
	}
/////////////////get blog comments//////////////////////
public function All_comments_blogs(Bcomment $bcomment , Request $request)
{
	//blog id ajax request
	$pid=$request->blogid;
	$blog_id = Bcomment::find($pid);
	$bcomments = $bcomment
		->join('blogs as b','b.id','=','bcomments.blog_id')
		->select(array('bcomments.id as bcomments_id',
						'b.title as blog_title',
						'bcomments.blog_id as blog_id',
						'bcomments.comment as comment',
						'bcomments.role as role',
						'bcomments.date as date'))
		->where('blog_id',$pid)->get();
session(['blogid' => $pid]);
$comment=[];
$i=0;
		foreach($bcomments as $bcomm){
			$role       = $bcomm->role;
			$comment_id = $bcomm->bcomments_id;
			if($role == 'Admin'){
				$bcomment_admin = $bcomment
				->join('blogs as b','b.id','=','bcomments.blog_id')
				->join('users as u','u.id','=','bcomments.person_id')
				->select(array(
						'bcomments.id as bcomments_id',
						'bcomments.blog_id as blog_id',
						'b.title as blog_title',
						'u.name as name',
						'bcomments.comment as comment',
						'bcomments.role as role',
						'bcomments.date as date'))
				->where('blog_id',$pid)->where('bcomments.id',$comment_id)->get();
				$comment[$i] = $bcomment_admin;
				$i++;
			}
			else{
			$bcomment_member = $bcomment
			  ->join('blogs as b','b.id','=','bcomments.blog_id')
				->join('members as m','m.id','=','bcomments.person_id')
				->select(array(
						'bcomments.id as bcomments_id',
						'bcomments.blog_id as blog_id',
						'b.title as blog_title',
						'm.username as name',
						'm.image as image',
						'bcomments.comment as comment',
						'bcomments.role as role',
						'bcomments.date as date'))
				->where('blog_id',$pid)->where('bcomments.id',$comment_id)->get();
				$comment[$i] = $bcomment_member;
				$i++;
			}
		}
foreach($comment as $key=>$value){
				if($value[0]['role'] == 'member'){
			 echo '<article class="row">
					<div class="col-md-2 col-sm-2 hidden-xs">
<figure class="thumbnail"> <img class="img-responsive" src="../images/uploads/'.$value[0]["image"].' " alt="" />
</figure>
					</div>
					<div class="col-md-10 col-sm-10">
						<div class="panel panel-default">
							<div class="panel-body">
								<header class="text-right">
									<div class="comment-user">'.$value[0]["name"].'</div>
									<time class="comment-date" datetime="2015-12-20T08:00"> '.$value[0]["date"].' </time>
								</header>
								<div class="comment-post">
									<p> '.$value[0]['comment'].'  </p>
								</div>
							</div>
						</div>
					</div>
				</article>';
		}
				else{
				echo '<article class="row">
					<div class="col-md-12">
						<div class="panel panel-primary text-right">
							<div class="panel-body bg-danger">
								<header class="text-right">
									<div class="comment-user">فريق كوره لايف</div>
									<time class="comment-date" datetime="2015-12-20T08:00"> '.$value[0]['date'].'</time>
								</header>
								<div class="comment-post">
									<p> '.$value[0]['comment'].'</p>
								</div>
							</div>
						</div>
					</div>
				</article>';
				}
}
}
///////////////////get post comments////////////////////////
	public function All_comments(Pcomment $pcomment , Request $request)
	{
		//post id ajax request
		$pid=$request->postid;
		$post_id = Pcomment::find($pid);
		$pcomments = $pcomment
			->join('posts as p','p.id','=','pcomments.post_id')
			->select(array('pcomments.id as pcomments_id',
							'p.title as Post_title',
							'pcomments.post_id as Post_id',
							'pcomments.comment as comment',
							'pcomments.role as role',
							'pcomments.date as date'))
			->where('Post_id',$pid)->get();
 session(['postid' => $pid]);
$comment=[];
$i=0;
			foreach($pcomments as $pcomm){
				$role       = $pcomm->role;
				$comment_id = $pcomm->pcomments_id;
				if($role == 'Admin'){
					$pcomment_admin = $pcomment
					->join('posts as p','p.id','=','pcomments.post_id')
					->join('users as u','u.id','=','pcomments.person_id')
					->select(array(
								'pcomments.id as pcomments_id',
								'pcomments.post_id as Post_id',
							'p.title as Post_title',
							'u.name as name',
							'pcomments.comment as comment',
							'pcomments.role as role',
							'pcomments.date as date'))
					->where('Post_id',$pid)->where('pcomments.id',$comment_id)->get();
					$comment[$i] = $pcomment_admin;
					$i++;
				}
				else{
				$pcomment_member = $pcomment
					->join('posts as p','p.id','=','pcomments.post_id')
					->join('members as m','m.id','=','pcomments.person_id')
					->select(array(
								'pcomments.id as pcomments_id',
								'pcomments.post_id as Post_id',
							'p.title as Post_title',
							'm.username as name',
							'm.image as image',
							'pcomments.comment as comment',
							'pcomments.role as role',
							'pcomments.date as date'))
					->where('Post_id',$pid)->where('pcomments.id',$comment_id)->get();
					$comment[$i] = $pcomment_member;
					$i++;
				}
			}
 foreach($comment as $key=>$value){
					if($value[0]['role'] == 'member'){
				 echo '<article class="row">
						<div class="col-md-2 col-sm-2 hidden-xs">
	<figure class="thumbnail"> <img class="img-responsive" src="../images/uploads/'.$value[0]["image"].' " alt="" />
	</figure>
						</div>
						<div class="col-md-10 col-sm-10">
							<div class="panel panel-default">
								<div class="panel-body">
									<header class="text-right">
										<div class="comment-user">'.$value[0]["name"].'</div>
										<time class="comment-date" datetime="2015-12-20T08:00"> '.$value[0]["date"].' </time>
									</header>
									<div class="comment-post">
										<p> '.$value[0]['comment'].'  </p>
									</div>
								</div>
							</div>
						</div>
					</article>';
			}
					else{
					echo '<article class="row">
						<div class="col-md-12">
							<div class="panel panel-primary text-right">
								<div class="panel-body bg-danger">
									<header class="text-right">
										<div class="comment-user">فريق كوره لايف</div>
										<time class="comment-date" datetime="2015-12-20T08:00"> '.$value[0]['date'].'</time>
									</header>
									<div class="comment-post">
										<p> '.$value[0]['comment'].'</p>
									</div>
								</div>
							</div>
						</div>
					</article>';
					}
}
	}
	//////////////////////////////////////////////////////////////////////////////////////

		public function loadmore(Request $request)
		{
					if(strchr($request->url() ,'news') !== false){
						$output='';
						$lastid=$request->lastid;
						$n = new Snew;
						$newsload = $n->where('id','<',$lastid)->take(10)->orderBy('id','desc')->get();
						if(count($newsload) > 0){
						foreach($newsload as $new){
						$output .= '
								<div class="box-body col-sm-12">
									<div class="bordered-content">
										<h3 class="text-uppercase"> <a href="news/'.$new->id.'">'.$new->title.'</a></h3>
										<p class="text-muted"> القسم: <a href="#">كرة عربية</a> </p>
										<a href="news/'.$new->id.'" >
										<figure> <img class="img-responsive" alt="'.$new->flag.'" src="images/uploads/'.$new->flag.'"> </figure>
										</a>
										<div class="post-header">
											<div class="box-sub-info">
												<ul class="list-inline no-padding-right text-primary row">
													<li class="col-sm-4"><i class="icofont icofont-calendar"></i>'.$new->date.'</li>
													<li class="col-sm-4"><i class="icofont icofont-eye-alt"></i>'.$new->likes.' اعجاب</li>
													<li class="col-sm-4"><i class="icofont icofont-speech-comments"></i>4 تعليقات</li>
												</ul>
												<hr>
											</div>
											<p class="box-desc">'.$new->additional_info.'</p>
											<hr>
											<a href="news/'.$new->id.'" class="btn btn-orange btn-lg btn-block hvr-sweep-to-right-primary">استكمل القراءة</a> </div>
									</div>
								</div>';
						}
						$output .='<div id="remove">
								<div class="col-sm-6 col-lg-offset-3">
									<button class="btn btn-block btn-orange" id="btn_more" data-id="'.$new->id.'">أظهر المزيد</button>
								</div>
							</div>';

						}
						echo $output;
					}
						else if(strchr($request->url() ,'posts') !== false){
							$output='';
							$count = 0;
							$lastid=$request->lastid;
							$p = new Post;
							$postsload = $p->where('id','<',$lastid)->take(9)->orderBy('id','desc')->get();
							if(count($postsload) > 0){
								$output .='<div class="column size-1of3">';
							foreach($postsload as $post){
							$count++;
							$output .= '
							<div class="blog-post-body col-sm-12">
								<div class="bordered-content">
									<h3 class="text-uppercase"><a href="posts/'.$post->id.'">'.$post->title.'</a></h3>
									<a href="posts/'.$post->id.'">
									<figure><img alt="'.$post->alt.'" src="images/uploads/'.$post->flag.'" class="img-responsive"></figure>
									</a>
									<div class="box-sub-info box-sub-info-bordered">
										<ul class="list-inline no-padding-right text-primary row">
										<li class="col-sm-4"><a class="btn btn-sm btn-default btn-block" href="Allposts'.$post->date.'"><i class="icofont icofont-calendar"></i>'.$post->date.' </a></li>
										<li class="col-sm-4"><i class="icofont icofont-eye-alt"></i>'.$post->likes.' أعجاب</a></li>
										<li class="col-sm-4"><i class="icofont icofont-speech-comments"></i>'.$post->comments.' تعليقات</a></li>
								  	</ul>
									</div>
									<p>'.$post->body.'</p>
									<hr>
									<a class="btn btn-primary btn-block hvr-sweep-to-right-primary" href="posts/'.$post->id.'">استكمل القراءة...</a> </div>
							</div>';
						 if($count == 3 ){
									$output .= '</div><div class="column size-1of3">';
									$count = 0;
							}
							}
							$output .='</div>';
							$output .='
							<div id="remove">
								 <div class="col-sm-6 col-lg-offset-3">
									 <button class="btn btn-block btn-orange" id="btn_more" data-id="'.$post->id.'">أظهر المزيد</button>
								 </div>
							 </div>
							';
							}
							echo $output;
						}
							else if(strchr($request->url() ,'gallary') !== false){
								$output='';
								$lastid=$request->lastid;
								$g = new G_album_photo;
								$galleryload = $g->where('id','<',$lastid)->take(10)->orderBy('id','desc')->get();
								$first_objs=$galleryload[0];
								$fid=$first_objs->id;
								if(count($first_objs) > 0)
								{
								$output .= '
								<div class="row" id="photo">
									<div class="col-sm-12" >
										<div class="row">
											<div class="master-photo box-body col-sm-6">
												<figure class="gallery-box">
													<div class="box">
														<div class="slide"><img class="img-responsive" alt="" src="images/uploads/'.$first_objs->flag .'"/>
															<div class="overlay"></div>
															<div class="overlay-info">
																 <span class="details-action"><a href="images/uploads/'. $first_objs->flag .'" class="popup-img">
																	 <i class="action-icon icofont icofont-maximize"></i></a></span>
																<div class="info text-center">
																	<h4 class="text-uppercase">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h4>
																</div>
															</div>
														</div>
													</div>
												</figure>
											</div>

										';

												$second_objs=$g->where('id','<',$fid)->orderBy('id','desc')->take(4)->get();
												if(count($second_objs)>0)
												{
														$output .= '  <div class="col-sm-6">
																<div class="row">';
																if(count($second_objs)>1)
																{
																foreach ($second_objs as $sobj) {
																	$output.='
																	<div class="box-body col-sm-6">
																		<figure class="gallery-box">
																			<div class="box">
																				<div class="slide"><img class="img-responsive" alt="" src="images/uploads/'.$sobj->flag .'"/>
																					<div class="overlay"></div>
																					<div class="overlay-info"> <span class="details-action"><a href="images/uploads/'. $sobj->flag .'" class="popup-img"><i class="action-icon icofont icofont-maximize"></i></a></span>
																						<div class="info text-center">
																							<h4 class="text-uppercase">{{ $obj->flag }}</h4>
																						</div>
																					</div>
																				</div>
																			</div>
																		</figure>
																	</div>';

																}
																	$output.='</div></div>';
																		$sid=$second_objs[sizeof($second_objs) - 1]->id;


																			$sid=$second_objs[sizeof($second_objs) - 1]->id;
																			$three_objs=$g->where('id','<',$sid)->orderBy('id','desc')->take(4)->get();
																			if(count($three_objs)>0)
																			{
																					$output .= '  <div class="col-sm-6">
																							<div class="row">';
																							if(count($three_objs)>1)
																							{
																							foreach ($three_objs as $sobj) {
																								$output.='
																								<div class="box-body col-sm-6">
																									<figure class="gallery-box">
																										<div class="box">
																											<div class="slide"><img class="img-responsive" alt="" src="images/uploads/'.$sobj->flag .'"/>
																												<div class="overlay"></div>
																												<div class="overlay-info"> <span class="details-action"><a href="images/uploads/'. $sobj->flag .'" class="popup-img"><i class="action-icon icofont icofont-maximize"></i></a></span>
																													<div class="info text-center">
																														<h4 class="text-uppercase">{{ $obj->flag }}</h4>
																													</div>
																												</div>
																											</div>
																										</div>
																									</figure>
																								</div>';

																							}

																									$th_id=$three_objs[sizeof($three_objs) - 1]->id;

																									// $output .='<div id="remove">
																									// 		<div class="col-sm-6 col-lg-offset-3">
																									// 			<button class="btn btn-block btn-orange" id="btn_more" data-id="'.$th_id.'">أظهر المزيد</button>
																									// 		</div>
																									// 	</div>';
																										// forth_objs
																										$th_id=$three_objs[sizeof($three_objs) - 1]->id;
																							      $forth_objs=$g->where('id','<',$th_id)->orderBy('id','desc')->first();
																							      $lastid=$th_id;
																							      if(count($forth_objs)>0)
																							      {
																							          $lastid=$forth_objs->id;
																												// div of forth
																												$output.='</div></div>';

																												$output.='
																												<div class="master-photo box-body col-sm-6">
																													<figure class="gallery-box">
																														<div class="box">
																															<div class="slide"><img class="img-responsive" alt="" src="images/uploads/'. $forth_objs->flag.'"/>
																																<div class="overlay"></div>
																																<div class="overlay-info"> <span class="details-action"><a href="images/uploads/'.$forth_objs->flag .'" class="popup-img"><i class="action-icon icofont icofont-maximize"></i></a></span>
																																	<div class="info text-center">
																																		<h4 class="text-uppercase">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h4>
																																	</div>
																																</div>
																															</div>
																														</div>
																													</figure>
																												</div>';
																												$output .='<div id="remove">
																														<div class="col-sm-6 col-lg-offset-3">
																															<button class="btn btn-block btn-orange" id="btn_more" data-id="'.$th_id.'">أظهر المزيد</button>
																														</div>
																													</div>';
																										}

																							}

																			else {
																				$output.='
																				<div class="box-body col-sm-6">
																					<figure class="gallery-box">
																						<div class="box">
																							<div class="slide"><img class="img-responsive" alt="" src="images/uploads/'.$three_objs->flag .'"/>
																								<div class="overlay"></div>
																								<div class="overlay-info"> <span class="details-action"><a href="images/uploads/'. $three_objs->flag .'" class="popup-img"><i class="action-icon icofont icofont-maximize"></i></a></span>
																									<div class="info text-center">
																										<h4 class="text-uppercase">{{ $obj->flag }}</h4>
																									</div>
																								</div>
																							</div>
																						</div>
																					</figure>
																				</div>';
																					$th_id=$three_objs[sizeof($three_objs) - 1]->id;
																					$output .='<div id="remove">
																							<div class="col-sm-6 col-lg-offset-3">
																								<button class="btn btn-block btn-orange" id="btn_more" data-id="'.$th_id.'">أظهر المزيد</button>
																							</div>
																						</div>';
																			}

												}
												else {
													$output .='<div id="remove">
															<div class="col-sm-6 col-lg-offset-3">
																<button class="btn btn-block btn-orange" id="btn_more" data-id="'.$sid.'">أظهر المزيد</button>
															</div>
														</div>';
												}

																}

												else {
													$output.='
													<div class="box-body col-sm-6">
														<figure class="gallery-box">
															<div class="box">
																<div class="slide"><img class="img-responsive" alt="" src="images/uploads/'.$second_objs->flag .'"/>
																	<div class="overlay"></div>
																	<div class="overlay-info"> <span class="details-action"><a href="images/uploads/'. $second_objs->flag .'" class="popup-img"><i class="action-icon icofont icofont-maximize"></i></a></span>
																		<div class="info text-center">
																			<h4 class="text-uppercase">{{ $obj->flag }}</h4>
																		</div>
																	</div>
																</div>
															</div>
														</figure>
													</div>';
														$sid=$second_objs[sizeof($second_objs) - 1]->id;
														$output .='<div id="remove">
																<div class="col-sm-6 col-lg-offset-3">
																	<button class="btn btn-block btn-orange" id="btn_more" data-id="'.$sid.'">أظهر المزيد</button>
																</div>
															</div>';
												}

					}

								}
									echo $output;

							}
								else if(strchr($request->url() ,'vedios') !== false){
									$output='';
									$lastid=$request->lastid;
									$count = 0 ;
									$v = new V_album;
									$vediosload = $v->where('id','<',$lastid)->take(6)->orderBy('id','desc')->get();
									if(count($vediosload) > 0){
									foreach($vediosload as $vedio){
									$count++;
									$output .= '
									<div class="box-body col-sm-4">
											<div class="bordered padding-all">
											<a class="details" href="vedios/'.$vedio->id.'">
												<figure title="<h3 class="text-uppercase text-info">'.$vedio->title.'</h3>
													<p>'.$vedio->description.'</p>">
												<h3 class="text-uppercase text-info">'.$vedio->title.'</h3>
												<div  class="vid-box">
													<i class="icofont icofont-ui-play"></i>
													<img class="img-responsive" alt="" src="images/uploads/'.$vedio->flag.'"> </div>
											</figure>
											</a>
											<div class="box-sub-info">
												<ul class="list-inline no-padding-right text-primary row">
													<li class="col-sm-4">
														<a class="btn btn-sm btn-default btn-block" href="#">
															<i class="icofont icofont-calendar"></i>'. $vedio->date.'
														</a>
													</li>
													<li class="col-sm-4">
														<a class="btn btn-sm btn-default btn-block" href="#">
															<i class="icofont icofont-eye-alt"></i>'.$vedio->view_count .'مشاهدة
														</a>
													</li>

													<li class="col-sm-4">
														<a class="btn btn-sm btn-default btn-block" href="#">
															<i class="icofont icofont-speech-comments"></i>'.$vedio->like_count.' اعجاب
														</a>
													</li>

												</ul>
											</div>
											</div>
											</div>';
										if($count == 6 ){
										$output .='<div class="col-sm-12 text-center ad"><img class="img-responsive" src="images/uploads/728-90-ad.gif" width="728" height="90" alt=""/></div>';
									}
							}
							$output .='<div id="remove">
												 <div class="col-sm-6 col-lg-offset-3">
													 <button class="btn btn-block btn-orange" id="btn_more" data-id="'.$vedio->id.'">أظهر المزيد</button>
												 </div>
											 </div>';
									}
									echo $output;
								}
								else{
									$output='';
									$count = 0;
									$lastid=$request->lastid;
									$b = new Blog;
									$blogsload = $b->where('id','<',$lastid)->take(9)->orderBy('id','desc')->get();
									if(count($blogsload) > 0){
									$output .='<div class="column size-1of3">';
									foreach($blogsload as $blog){
									$count++;
									$output .= '
									<div class="blog-post-body col-sm-12">
				            <div class="bordered-content">
				              <h3 class="text-uppercase"><a href="blogs/'.$blog->id.'">'.$blog->title.'</a></h3>

				               <a href="blogs/'.$blog->id.'">
				                <figure>
				              <div  class="vid-box">
				                <i class="icofont icofont-ui-play"></i>
				               <img class="img-responsive" alt="" src="images/uploads/'.$blog->flag.'"> </div>
				            </figure>
				            </a>
				              <div class="box-sub-info box-sub-info-bordered">
				                <ul class="list-inline no-padding-right text-primary row">
				                <li class="col-sm-4"><i class="icofont icofont-calendar"></i>'.$blog->date.'</li>
				                <li class="col-sm-4"><i class="icofont icofont-eye-alt"></i>'.$blog->likes.'  أعجاب</li>
				                <li class="col-sm-4"><i class="icofont icofont-speech-comments"></i>'.$blog->author.'  الكاتب</li>
				                <!-- comments we need to add field to count comments in db  -->
				              </ul>
				              </div>
				              <p>'.$blog->body.'</p>
				              <hr>
				              <a class="btn btn-primary btn-block hvr-sweep-to-right-primary" href="blogs/'.$blog->id.'">استكمل القراءة...</a> </div>
				          </div>';
									if($count == 3 ){
		 									$output .= '</div><div class="column size-1of3">';
		 									$count = 0;
		 							}
		 							}
		 							$output .='</div>';
		 							$output .='
		 							<div id="remove">
		 								 <div class="col-sm-6 col-lg-offset-3">
		 									 <button class="btn btn-block btn-orange" id="btn_more" data-id="'.$blog->id.'">أظهر المزيد</button>
		 								 </div>
		 							 </div>
		 							';
		 							}
		 							echo $output;
								}
		}

	//increase likes news
		public function increase_like(Request $request)
		{
			$id     = $request->id;
			$url    = $request->url;
			if($url == 'news'){
				$new = Snew::where('id',$id)->first();
				$new->likes   = $new->likes + 1;
				$new->save();
			}
		else if($url == 'vedios'){
			$video = V_album::where('id',$id)->first();
			$video->like_count   = $video->like_count + 1;
			$video->save();
		}
		else if($url == 'posts'){
			$post = Post::where('id',$id)->first();
			$post->likes   = $post->likes + 1;
			$post->save();
		}
		else{
			$blog = Blog::where('id',$id)->first();
			$blog->likes   = $blog->likes + 1;
			$blog->save();
		}
					return response(array('msg' => 'Adding Successfull'), 200)
										->header('Content-Type', 'application/json');
		}

	//decrease likes
			public function decrease_like(Request $request)
			{
				$id     = $request->id;
				$url    = $request->url;
				if($url == 'news'){
					$new = Snew::where('id',$id)->first();
					$new->likes   = $new->likes - 1;
					$new->save();
				}
			else if($url == 'vedios'){
				$video = V_album::where('id',$id)->first();
				$video->like_count   = $video->like_count - 1;
				$video->save();
			}
			else if($url == 'posts'){
				$post = Post::where('id',$id)->first();
				$post->likes   = $post->likes - 1;
				$post->save();
			}
			else{
				$blog = Blog::where('id',$id)->first();
				$blog->likes   = $blog->likes - 1;
				$blog->save();
			}
						return response(array('msg' => 'Adding Successfull'), 200)
											->header('Content-Type', 'application/json');
			}
}
