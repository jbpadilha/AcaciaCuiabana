package br.com.joaopadilha.attomos.game.objects;

public class Answers {
	
	private Questions question;
	private String answer;
	private boolean correctAnswer;
	
	public Answers(Questions questionPass, String answerPass, boolean correct){
		question = questionPass;
		answer = answerPass;
		correctAnswer = correct; 
	}
	
	public Answers(Questions questionPass, String answerPass){
		question = questionPass;
		answer = answerPass;
		correctAnswer = false; 
	}

	public Questions getQuestion() {
		return question;
	}

	public void setQuestion(Questions question) {
		this.question = question;
	}

	public String getAnswer() {
		return answer;
	}

	public void setAnswer(String answer) {
		this.answer = answer;
	}

	public boolean isCorrectAnswer() {
		return correctAnswer;
	}

	public void setCorrectAnswer(boolean correctAnswer) {
		this.correctAnswer = correctAnswer;
	}
	
	
	
}
