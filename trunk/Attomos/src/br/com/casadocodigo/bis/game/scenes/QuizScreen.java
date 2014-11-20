package br.com.casadocodigo.bis.game.scenes;

import static br.com.casadocodigo.bis.config.DeviceSettings.screenHeight;
import static br.com.casadocodigo.bis.config.DeviceSettings.screenResolution;
import static br.com.casadocodigo.bis.config.DeviceSettings.screenWidth;

import java.util.ArrayList;
import java.util.List;

import org.cocos2d.layers.CCLayer;
import org.cocos2d.layers.CCScene;
import org.cocos2d.nodes.CCDirector;
import org.cocos2d.opengl.CCBitmapFontAtlas;
import org.cocos2d.types.CGPoint;

import android.widget.EditText;
import br.com.casadocodigo.bis.config.Assets;
import br.com.casadocodigo.bis.game.control.Button;
import br.com.casadocodigo.bis.game.control.ButtonDelegate;
import br.com.casadocodigo.bis.game.objects.Answers;
import br.com.casadocodigo.bis.game.objects.Questions;
import br.com.casadocodigo.bis.screens.ScreenBackground;


public class QuizScreen extends CCLayer implements ButtonDelegate{

	private ScreenBackground background;
	private Button beginButton;
	private Button nextButton;
	public static List<Questions> questionslist = new ArrayList<Questions>();
	
	CCBitmapFontAtlas showQuestion;
	
	public CCScene scene() {
		CCScene scene = CCScene.node();
		scene.addChild(this);
		return scene;
	}
	
	public QuizScreen(int newQuiz) {
		
		this.background = new ScreenBackground(Assets.BACKGROUND);
		this.background.setPosition(screenResolution(CGPoint.ccp(screenWidth() / 2.0f, screenHeight() / 2.0f)));
		this.addChild(this.background);
		createQuestions();
		
		this.showQuestion = CCBitmapFontAtlas.bitmapFontAtlas(
				String.valueOf(questionslist.get(newQuiz).getQuestion()),"UniSansBold_AlphaNum_50_red.fnt");
		this.showQuestion.setScale((float) 240 / 240);
		this.showQuestion.setPosition(screenWidth()/2, (screenHeight()/2)+100);
		this.addChild(this.showQuestion);
	}

	@Override
	public void buttonClicked(Button sender) {
				
	}
	
	
	public void createQuestions()
	{
		//Questions 1
		Questions question1 = new Questions();
		question1.setCodQuestion(1);
		question1.setQuestion("Questão 1");
		
			//Answers
			question1.addAnswers(new Answers(question1, "Resposta 1",true));
			question1.addAnswers(new Answers(question1, "Resposta 2"));
			question1.addAnswers(new Answers(question1, "Resposta 3"));
			question1.addAnswers(new Answers(question1, "Resposta 4"));
		
		//Questions 2
		Questions question2 = new Questions();
		question2.setCodQuestion(2);
		question2.setQuestion("Questão 2");
			
			//Answers
			question2.addAnswers(new Answers(question2, "Resposta 1"));
			question2.addAnswers(new Answers(question2, "Resposta 2",true));
			question2.addAnswers(new Answers(question2, "Resposta 3"));
			question2.addAnswers(new Answers(question2, "Resposta 4"));
			
			
		//Questions 3
		Questions question3 = new Questions();
		question3.setCodQuestion(3);
		question3.setQuestion("Questão 3");
				
			//Answers
			question3.addAnswers(new Answers(question3, "Resposta 1"));
			question3.addAnswers(new Answers(question3, "Resposta 2",true));
			question3.addAnswers(new Answers(question3, "Resposta 3"));
			question3.addAnswers(new Answers(question3, "Resposta 4"));
		
			
			
		//Questions 4
		Questions question4 = new Questions();
		question1.setCodQuestion(4);
		question1.setQuestion("Questão 4");
				
			//Answers
			Answers answer4_1 = new Answers(question1, "Resposta 1");
			Answers answer4_2 = new Answers(question1, "Resposta 2");
			Answers answer4_3 = new Answers(question1, "Resposta 3");
			Answers answer4_4 = new Answers(question1, "Resposta 4");
			question1.addAnswers(answer4_1);
			question1.addAnswers(answer4_2);
			question1.addAnswers(answer4_3);
			question1.addAnswers(answer4_4);
	
			
		questionslist.add(question1);
		questionslist.add(question2);
		questionslist.add(question3);
		questionslist.add(question4);
		
			
	}
	
	
	
}