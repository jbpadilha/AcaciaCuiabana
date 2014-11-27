package br.com.casadocodigo.bis.game.objects;

import java.util.ArrayList;
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
}	
