kviz_users (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'username varchar(50) NOT NULL,)
			
			
kviz_quizzes (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'title varchar(250) NOT NULL)'

kviz_questions (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_quiz INT NOT NULL,' .
			'question_number INT NOT NULL'.
			'answer_input_type varchar(50) NOT NULL'. //moze biti 'checkbox' (onda trazi u kviz_ponudjeni_odgovori) ili 'textbox'
			'question_text varchar(1000) NOT NULL,'.
			'correct_answer_text varchar(1000) NOT NULL)'
			
kviz_questions (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_question INT NOT NULL,' .
			'ponudjeni_odgovor_number INT NOT NULL'.
			'ponudjeni_odgovor_text varchar(1000) NOT NULL,)'
			
kviz_results (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_user INT NOT NULL,' .
			'id_quiz INT NOT NULL,'.
			'quiz_result int)'
