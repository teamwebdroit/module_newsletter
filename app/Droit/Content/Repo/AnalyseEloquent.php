<?php namespace Droit\Content\Repo;

use Droit\Content\Repo\AnalyseInterface;
use Droit\Content\Entities\Analyse as M;

class AnalyseEloquent implements AnalyseInterface
{

    protected $analyse;

    /**
     * Construct a new SentryUser Object
     */
    public function __construct(M $analyse)
    {
        $this->analyse = $analyse;
    }

    public function getAll($include = [])
    {

        $analyse = $this->analyse->where('analyses.deleted', '=', 0);

        if (!empty($include)) {
            $analyse->whereIn('id', $include);
        }

        return $analyse->with(array('analyse_authors','analyses_categories' => function ($query) {
                
                    $query->orderBy('sorting', 'ASC');
        },'analyses_arrets' => function ($query) {
                

        }))->orderBy('pub_date', 'DESC')->get();
    }

    public function find($id)
    {
                
        return $this->analyse->where('id', '=', $id)->with(array('analyse_authors','analyses_categories','analyses_arrets'))->get()->first();
    }

    public function create(array $data)
    {

        $analyse = $this->analyse->create(array(
            'pid'        => $data['pid'],
            'user_id'    => $data['user_id'],
            'authors'    => $data['authors'],
            'pub_date'   => $data['pub_date'],
            'abstract'   => $data['abstract'],
            'file'       => $data['file'],
            'categories' => $data['categories'],
            'arrets'     => $data['arrets'],
            'title'      => isset($data['title']) && !empty($data['title']) ? $data['title'] : null,
            'created_at' => date('Y-m-d G:i:s'),
            'updated_at' => date('Y-m-d G:i:s')
        ));

        if (! $analyse) {
            return false;
        }

        if (isset($data['author_id']) && !empty($data['author_id'])) {
            $analyse->analyse_authors()->sync($data['author_id']);
        }
        
        return $analyse;
        
    }
    
    public function update(array $data)
    {

        $analyse = $this->analyse->findOrFail($data['id']);
        
        if (! $analyse) {
            return false;
        }

        $analyse->authors    = $data['authors'];
        $analyse->pub_date   = $data['pub_date'];
        $analyse->abstract   = $data['abstract'];

        if (isset($data['title'])) {
            $analyse->title = !empty($data['title']) ? $data['title'] : null;
        }

        if (isset($data['file']) && !empty($data['file'])) {
            $analyse->file = $data['file'];
        }

        $analyse->categories = $data['categories'];
        $analyse->arrets     = $data['arrets'];
        $analyse->updated_at = date('Y-m-d G:i:s');

        $analyse->save();

        if (isset($data['author_id']) && !empty($data['author_id'])) {
            $analyse->analyse_authors()->sync($data['author_id']);
        }
        
        return $analyse;
    }

    public function delete($id)
    {

        $analyse = $this->analyse->find($id);

        return $analyse->delete();
        
    }
}
