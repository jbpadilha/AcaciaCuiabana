package br.com.casadocodigo.bis.game.objects;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

public class Questions {

	private Integer codQuestion;
	private String question;
	List<Answers> answersList = new ArrayList<Answers>();
	
	public Integer getCodQuestion() {
		return codQuestion;
	}
	public void setCodQuestion(Integer codQuestion) {
		this.codQuestion = codQuestion;
	}
	public String getQuestion() {
		return question;
	}
	public void setQuestion(String question) {
		this.question = question;
	}
	
	public void addAnswers(Answers answers)
	{
		answersList.add(answers);	
	}
	public List<Answers> getAnswers(){
		return answersList;
	}
	
	public Answers getCorrectAnswer(){
		Iterator itAnswer = answersList.iterator();
		while (itAnswer.hasNext()){
			Answers correctAnswer = (Answers) itAnswer.next();
			if(correctAnswer.isCorrectAnswer()){
				return correctAnswer;
			}
		}
		return null;
	}
	
}	
