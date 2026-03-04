<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article as ArticleModel;

class Article extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $showDeleteModal = false;
    public $editMode = false;
    
    public $articleId;
    public $title;
    public $body;
    public $photo_path;
    public $lang = 'ar';
    public $published = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'photo_path' => 'nullable|string',
        'lang' => 'required|in:ar,en,fr',
        'published' => 'boolean',
    ];

    public function render()
    {
        $articles = ArticleModel::where('title', 'like', '%'.$this->search.'%')
            ->orWhere('body', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(10);

        return view('livewire.article', compact('articles'));
    }

    public function create()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $article = ArticleModel::findOrFail($id);
        $this->articleId = $id;
        $this->title = $article->title;
        $this->body = $article->body;
        $this->photo_path = $article->photo_path;
        $this->lang = $article->lang;
        $this->published = $article->published;
        
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'body' => $this->body,
            'photo_path' => $this->photo_path,
            'lang' => $this->lang,
            'published' => $this->published,
        ];

        if ($this->editMode) {
            ArticleModel::where('id', $this->articleId)->update($data);
            session()->flash('success', 'تم تحديث المقال بنجاح');
        } else {
            ArticleModel::create($data);
            session()->flash('success', 'تم إنشاء المقال بنجاح');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->articleId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        ArticleModel::destroy($this->articleId);
        session()->flash('success', 'تم حذف المقال بنجاح');
        $this->showDeleteModal = false;
    }

    private function resetForm()
    {
        $this->reset(['articleId', 'title', 'body', 'photo_path', 'lang', 'published']);
    }
}
