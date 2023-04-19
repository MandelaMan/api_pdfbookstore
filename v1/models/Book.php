<?php

  class Book {

  	private $conn;
  	private $table_books = 'books';
  	private $table_categories = 'categories';

  	public $id;
  	public $code;
  	public $name;
		public $title;
		public $subtitle;
		public $author;
		public $size;
		public $year;
		public $description;
		public $img_link;
		public $category;
		public $book_formart;
		public $approval_status;
		public $is_free;
		public $views_by_click;
		public $downloads;
		public $created_at;
		public $updated_at;
		public $added_by;

  	public function __construct($db){
		    $this->conn = $db;
		} 

		public function bookExists(){

			$query = 'SELECT EXISTS(SELECT * FROM '.$this->table_books.' WHERE id =:id)';

	        $stmt = $this->conn->prepare($query);

			$stmt->bindParam(':id',$this->id);

	        $result = $stmt->execute();

	        return $result;
		}

		public function addBook(){

			$query = 'INSERT INTO '.$this->table_books.'
	  		        SET 
	  		        code=:code,
								title=:title,
								subtitle=:subtitle,
								author=:author,
								size=:size,
								pages=:pages,
								book_formart=:book_formart,
								year=:year,
								description=:description,
								img_link=:img_link,
								category=:category,
								is_free=:is_free,
								views_by_click=:views_by_click,
								downloads=:downloads,
								added_by=:added_by';

						$stmt = $this->conn->prepare($query);

				  	$this->code = htmlspecialchars(strip_tags($this->code));
				  	$this->title = htmlspecialchars(strip_tags($this->title));
				  	$this->subtitle = htmlspecialchars(strip_tags($this->subtitle));
						$this->author = htmlspecialchars(strip_tags($this->author));
						$this->size = htmlspecialchars(strip_tags($this->size));
						$this->pages = htmlspecialchars(strip_tags($this->pages));
						$this->book_formart = htmlspecialchars(strip_tags($this->book_formart));
						$this->year = htmlspecialchars(strip_tags($this->year));
						$this->description = htmlspecialchars(strip_tags($this->description));
						$this->img_link = htmlspecialchars(strip_tags($this->img_link));
						$this->category = htmlspecialchars(strip_tags($this->category));
						$this->is_free = htmlspecialchars(strip_tags($this->is_free));
						$this->views_by_click = htmlspecialchars(strip_tags($this->views_by_click));
						$this->downloads = htmlspecialchars(strip_tags($this->downloads));
						$this->added_by = htmlspecialchars(strip_tags($this->added_by));

						$stmt->bindParam(':code',$this->code);
						$stmt->bindParam(':title',$this->title);
						$stmt->bindParam(':subtitle',$this->subtitle);
						$stmt->bindParam(':author',$this->author);
						$stmt->bindParam(':size',$this->size);
						$stmt->bindParam(':pages',$this->pages);
						$stmt->bindParam(':book_formart',$this->book_formart);
						$stmt->bindParam(':year',$this->year);			
						$stmt->bindParam(':description',$this->description);
						$stmt->bindParam(':img_link',$this->img_link);
						$stmt->bindParam(':category',$this->category);
						$stmt->bindParam(':is_free',$this->is_free);
						$stmt->bindParam(':views_by_click',$this->views_by_click);
						$stmt->bindParam(':downloads',$this->downloads);
						$stmt->bindParam(':added_by',$this->added_by);

						$stmt->execute();

						return $this->conn->lastInsertId();
		}

		public function deleteBook(){

			$query = 'DELETE FROM '.$this->table_books.' WHERE id =:id';

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':id',$this->id);

			$stmt->execute();		
		}

		public function addClicks(){

			$query = 'UPDATE '.$this->table_books.'
	  		        SET
					`views_by_click` = `views_by_click` + 1
					WHERE id =:id';

			$stmt = $this->conn->prepare($query);

	  	$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bindParam(':id',$this->id);

			$stmt->execute();
		}

		public function updateBook(){

			$query = 'UPDATE '.$this->table_books.'
	  		        SET
					title=:title,
					subtitle=:subtitle,
					author=:author,
					size=:size,
					year=:year,
					description=:description,
					img_link=:img_link,
					category=:category,
					is_free=:is_free,
					views_by_click=:views_by_click,
					downloads=:downloads,
					updated_at=:updated_at,
					added_by=:added_by
					WHERE id =:id';

			$stmt = $this->conn->prepare($query);

	  		$this->id = htmlspecialchars(strip_tags($this->id));
	  		$this->title = htmlspecialchars(strip_tags($this->title));
	  		$this->subtitle = htmlspecialchars(strip_tags($this->subtitle));
			$this->author = htmlspecialchars(strip_tags($this->author));
			$this->size = htmlspecialchars(strip_tags($this->size));
			$this->year = htmlspecialchars(strip_tags($this->year));
			$this->description = htmlspecialchars(strip_tags($this->description));
			$this->img_link = htmlspecialchars(strip_tags($this->img_link));
			$this->category = htmlspecialchars(strip_tags($this->category));
			$this->is_free = htmlspecialchars(strip_tags($this->is_free));
			$this->views_by_click = htmlspecialchars(strip_tags($this->views_by_click));
			$this->downloads = htmlspecialchars(strip_tags($this->downloads));
			$this->added_by = htmlspecialchars(strip_tags($this->added_by));

			$stmt->bindParam(':id',$this->id);
			$stmt->bindParam(':title',$this->title);
			$stmt->bindParam(':subtitle',$this->subtitle);
			$stmt->bindParam(':author',$this->author);
			$stmt->bindParam(':size',$this->size);
			$stmt->bindParam(':year',$this->year);			
			$stmt->bindParam(':description',$this->description);
			$stmt->bindParam(':img_link',$this->img_link);
			$stmt->bindParam(':category',$this->category);
			$stmt->bindParam(':is_free',$this->is_free);
			$stmt->bindParam(':views_by_click',$this->views_by_click);
			$stmt->bindParam(':downloads',$this->downloads);
			$stmt->bindParam(':added_by',$this->added_by);
			$stmt->bindParam(':updated_at',$this->updated_at);

			$stmt->execute();
		}

		public function disableBook(){
			
		}


		public function getBook(){

			$query = 'SELECT 
			          b.*, 
			          c.name as category_name
			          FROM books as b 
			          LEFT JOIN categories as c ON (b.category = c.id) WHERE b.code = ? LIMIT 0,1';
			
			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(1, $this->code,PDO::PARAM_STR);

			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		} 

		public function getBooks(){

			$query = 'SELECT 
			        b.*, 
			        c.name as category_name
			        FROM 
			          '.$this->table_books.' b
			        LEFT JOIN 
			           categories c ON b.category = c.id 
			        ORDER BY 
			            b.created_at DESC';

			$stmt = $this->conn->prepare($query);

			$stmt->execute();

			return $stmt;
		} 

		public function getBooksByUploader(){

			$query = 'SELECT 
			          b.*, 
			          a.name as category_name, 
			          CONCAT(c.first_name," ",c.last_name) AS admin
			          FROM books AS b
			          LEFT JOIN categories as a ON (b.category=a.id)
			          LEFT JOIN admins as c ON (b.added_by=c.id) WHERE b.added_by = ? ORDER BY b.created_at DESC LIMIT 0,6';

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(1, $this->added_by,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt;
		}


		public function getBooksByCategory(){

			$query = 'SELECT 
			          b.*, 
			          c.name as category_name
			          FROM books as b 
			          LEFT JOIN categories as c ON (b.category = c.id) WHERE b.category = ? ORDER BY 
			            b.created_at DESC';

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(1, $this->category,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt;
		}
  }