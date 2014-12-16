package br.com.joaopadilha.attomos.game.scenes;

import static br.com.joaopadilha.attomos.config.DeviceSettings.screenHeight;
import static br.com.joaopadilha.attomos.config.DeviceSettings.screenResolution;
import static br.com.joaopadilha.attomos.config.DeviceSettings.screenWidth;

import java.util.ArrayList;
import java.util.List;

import org.cocos2d.layers.CCLayer;
import org.cocos2d.layers.CCScene;
import org.cocos2d.nodes.CCDirector;
import org.cocos2d.opengl.CCBitmapFontAtlas;
import org.cocos2d.types.CGPoint;

import br.com.joaopadilha.attomos.config.Assets;
import br.com.joaopadilha.attomos.config.Runner;
import br.com.joaopadilha.attomos.game.control.Button;
import br.com.joaopadilha.attomos.game.control.ButtonDelegate;
import br.com.joaopadilha.attomos.game.objects.Answers;
import br.com.joaopadilha.attomos.game.objects.Questions;
import br.com.joaopadilha.attomos.screens.ScreenBackground;


public class QuizScreen extends CCLayer implements ButtonDelegate{

	private ScreenBackground background;
	private Button buttonAlternativa0,buttonAlternativa1,buttonAlternativa2,buttonAlternativa3;
	Button buttonProximaQuestao;
	Button buttonRespostaAlternativaErrada,buttonRespostaAlternativaCerta;
	public static List<Questions> questionslist = new ArrayList<Questions>();
	//protected TextView questionTextView;
	protected CCBitmapFontAtlas alternativaCorretaTextView;
	protected CCBitmapFontAtlas tituloAlternativaCorretaTextView;
	int Questao = 0;//0 corresponde a alternativa 1
	
	
	CCBitmapFontAtlas showQuestion;
	CCBitmapFontAtlas showTitleQuestion;
	
	public CCScene scene() {
		CCScene scene = CCScene.node();
		scene.addChild(this);
		return scene;
	}
	
	public QuizScreen(int newQuiz) {
		
		
		//define qual questao corrente
		Questao = newQuiz;
		
		
		//define o backgroud da tela
		//this.background = new ScreenBackground(Assets.BACKGROUND);
		//define as posições
		//this.background.setPosition(screenResolution(CGPoint.ccp(screenWidth() / 2.0f, screenHeight() / 2.0f)));
		//adiciona na tela
		//this.addChild(this.background);
		
		//cria as questões e as alternativas correspondente a questão
		createQuestions();
		
		Questions questionChoosen = (Questions)questionslist.get(newQuiz);
		
		if(newQuiz == 0){
			this.background = new ScreenBackground(Assets.QUESTION_1);
		}else if(newQuiz == 1){
			this.background = new ScreenBackground(Assets.QUESTION_2);
		}else if(newQuiz == 2){
			this.background = new ScreenBackground(Assets.QUESTION_3);
		}else if(newQuiz == 3){
			this.background = new ScreenBackground(Assets.QUESTION_4);
		}
		this.background.setPosition(screenResolution(CGPoint.ccp(screenWidth() / 2.0f, screenHeight() / 2.0f)));
		//adiciona na tela
		this.addChild(this.background);
		
		
		// Mostra titulo
		this.showTitleQuestion = CCBitmapFontAtlas.bitmapFontAtlas(String.valueOf("QUIZZ"),"arial.fnt");
		this.showTitleQuestion.setScale((float) 120 /100);
		this.showTitleQuestion.setPosition(screenWidth()/2, (screenHeight())-20);
		this.addChild(this.showTitleQuestion);
		
		 
		
		//mostra na tela a alternativa correspondente a questão
			/*this.showQuestion = CCBitmapFontAtlas.bitmapFontAtlas(String.valueOf(questionslist.get(newQuiz).getQuestion()),"arial.fnt");
			this.showQuestion.setScale((float) 50 /100);
			this.showQuestion.setPosition(screenWidth()/2-80, (screenHeight())-40);
			this.addChild(this.showQuestion);*/
			//Coloca Background com a Questão:
			
		
			
			//busca as altenativas da questao
			int posicaoTelaAltenativa = -260;
			if(newQuiz == 3){
				posicaoTelaAltenativa = -300;
			}
			for(int i = 0; i<= questionChoosen.getAnswers().size()-1;i++){
				
				//obtem as altenativas da questão
				CCBitmapFontAtlas alternativa = CCBitmapFontAtlas.bitmapFontAtlas(String.valueOf(questionslist.get(newQuiz).getAnswers().get(i).getAnswer()),"arial.fnt");
				if(newQuiz!=2){
					alternativa.setScale((float) 60 / 100);
				}else{
					alternativa.setScale((float) 50 / 100);
				}
				//define a posição de cada alternativa
				if(newQuiz!=2){
					alternativa.setPosition(screenResolution(CGPoint.ccp(120 , (screenHeight())+posicaoTelaAltenativa )));
				}else{
					alternativa.setPosition(screenResolution(CGPoint.ccp(130 , (screenHeight())+posicaoTelaAltenativa )));
				}
				//adiciona as altenativa as tela
				this.addChild(alternativa);
				//define a proxima posição da altenativa
				
				if(i==0){//testa se é 1 alternativa da questão
					//adiciona o Proxima Questão na tela
					this.buttonAlternativa0 = new Button(Assets.SELECT);
					this.buttonAlternativa0.setDelegate(this);
					if(newQuiz!=2){
						this.buttonAlternativa0.setPosition(screenResolution(CGPoint.ccp(190 , (screenHeight())+posicaoTelaAltenativa )));
					}else{
						this.buttonAlternativa0.setPosition(screenResolution(CGPoint.ccp(290 , (screenHeight())+posicaoTelaAltenativa )));
					}
					this.addChild(this.buttonAlternativa0);
				}
				if(i==1){//testa se é 2 alternativa da questão
					//adiciona o Proxima Questão na tela
					this.buttonAlternativa1 = new Button(Assets.SELECT);
					this.buttonAlternativa1.setDelegate(this);
					if(newQuiz!=2){
						this.buttonAlternativa1.setPosition(screenResolution(CGPoint.ccp(190 , (screenHeight())+posicaoTelaAltenativa )));
					}else{
						this.buttonAlternativa1.setPosition(screenResolution(CGPoint.ccp(290 , (screenHeight())+posicaoTelaAltenativa )));
					}
					this.addChild(this.buttonAlternativa1);
					
				}
				if(i==2){//testa se é 3 alternativa da questão
					//adiciona o Proxima Questão na tela
					this.buttonAlternativa2 = new Button(Assets.SELECT);
					this.buttonAlternativa2.setDelegate(this);
					if(newQuiz!=2){
						this.buttonAlternativa2.setPosition(screenResolution(CGPoint.ccp(190 , (screenHeight())+posicaoTelaAltenativa )));
					}else{
						this.buttonAlternativa2.setPosition(screenResolution(CGPoint.ccp(290 , (screenHeight())+posicaoTelaAltenativa )));
					}
					this.addChild(this.buttonAlternativa2);
				}
				if(i==3){//testa se é 4 alternativa da questão
					//adiciona o Proxima Questão na tela
					this.buttonAlternativa3 = new Button(Assets.SELECT);
					this.buttonAlternativa3.setDelegate(this);
					if(newQuiz!=2){
						this.buttonAlternativa3.setPosition(screenResolution(CGPoint.ccp(190 , (screenHeight())+posicaoTelaAltenativa )));
					}else{
						this.buttonAlternativa3.setPosition(screenResolution(CGPoint.ccp(290 , (screenHeight())+posicaoTelaAltenativa )));
					}
					this.addChild(this.buttonAlternativa3);
				}

				posicaoTelaAltenativa = posicaoTelaAltenativa-30;//defiene a proxima posicao
				
				//fim adiciona o botao na tela
			}
			
		//adiciona o Proxima Questão na tela
		this.buttonProximaQuestao = new Button(Assets.NEXT);
		this.buttonProximaQuestao.setDelegate(this);
		this.buttonProximaQuestao.setPosition(screenResolution(CGPoint.ccp( screenWidth()-50 , 50 ))) ;
		this.addChild(this.buttonProximaQuestao);
		//fim adiciona o botao na tela
		
		
		
		//informa se a alternativa esta correta
		this.buttonRespostaAlternativaCerta = new Button(Assets.SUCESS);
		this.buttonRespostaAlternativaCerta.setPosition(screenResolution(CGPoint.ccp(screenWidth()/2 , 50 ))) ;
		this.buttonRespostaAlternativaCerta.setVisible(false);
		this.addChild(this.buttonRespostaAlternativaCerta);
	   //fiminforma se a alternativa esta correta
				
		//informa se a alternativa esta errada
		this.buttonRespostaAlternativaErrada = new Button(Assets.ERROR);
		if(newQuiz == 3){
			this.buttonRespostaAlternativaErrada.setPosition(screenResolution(CGPoint.ccp( screenWidth()/2 , 60 ))) ;
		}else{
			this.buttonRespostaAlternativaErrada.setPosition(screenResolution(CGPoint.ccp( screenWidth()/2 , 90 ))) ;
		}
		this.buttonRespostaAlternativaErrada.setVisible(false);
		this.addChild(this.buttonRespostaAlternativaErrada);
		
		this.tituloAlternativaCorretaTextView = CCBitmapFontAtlas.bitmapFontAtlas(String.valueOf("Correta:"),"arial.fnt");
		if(newQuiz!=2){
			this.tituloAlternativaCorretaTextView.setScale((float) 80 /100);
			if(newQuiz == 3){
				this.tituloAlternativaCorretaTextView.setPosition(40, 30);
			}else{
				this.tituloAlternativaCorretaTextView.setPosition(40, 60);
			}
		}else{
			this.tituloAlternativaCorretaTextView.setScale((float) 50 /100);
			this.tituloAlternativaCorretaTextView.setPosition(40, 50);
		}
		
		this.tituloAlternativaCorretaTextView.setVisible(false);
		this.addChild(this.tituloAlternativaCorretaTextView);
		
		
		Answers correctAnswer = questionslist.get(newQuiz).getCorrectAnswer();
		if(correctAnswer!=null){
			this.alternativaCorretaTextView = CCBitmapFontAtlas.bitmapFontAtlas(String.valueOf(correctAnswer.getAnswer()),"arial.fnt");
			if(newQuiz!=2){
				this.alternativaCorretaTextView.setScale((float) 80 /100);
				if(newQuiz == 3){
					this.alternativaCorretaTextView.setPosition(140, 30);
				}else{
					this.alternativaCorretaTextView.setPosition(100, 60);
				}
			}else{
				this.alternativaCorretaTextView.setScale((float) 50 /100);
				this.alternativaCorretaTextView.setPosition(130, 30);
			}
			this.alternativaCorretaTextView.setVisible(false);
			this.addChild(this.alternativaCorretaTextView);
		}
		//informa se a alternativa esta errada
		
		
		
		
		this.Questao = this.Questao+1;
	}

	@Override
	public void buttonClicked(Button sender) {

		
		if((this.Questao > 3)&&(sender == this.buttonProximaQuestao)){//se terminou as questões entao manda para tela de GameOver
			CCDirector.sharedDirector().replaceScene(new GameOverScreen(Runner.getFinalButton()).scene());
		}
		else{ //testa se é a ultma questao
			
			if(sender == this.buttonProximaQuestao){//testa se foi clicado no botao proximo
				
				CCDirector.sharedDirector().replaceScene(new QuizScreen(this.Questao).scene());
				
			}else{//senão testa os outros botoes
					if(sender == this.buttonAlternativa0){//testa se foi clicado na 1 altern.
						if(questionslist.get(this.Questao-1).getAnswers().get(0).isCorrectAnswer() == true){//testa se alternativa é verdadeira
							this.buttonRespostaAlternativaCerta.setVisible(true);
							this.buttonRespostaAlternativaErrada.setVisible(false);
							System.out.println("correto");
						}else{
							this.buttonRespostaAlternativaCerta.setVisible(false);
							this.buttonRespostaAlternativaErrada.setVisible(true);
							this.tituloAlternativaCorretaTextView.setVisible(true);
							this.alternativaCorretaTextView.setVisible(true);
							System.out.println("errado");
							
						}
						//this.buttonRespostaAlternativa0.setPosition(10,10);
						//this.addChild(this.buttonRespostaAlternativa0);
					}
					if(sender == this.buttonAlternativa1){//testa se foi clicado na 2 altern.
						if(questionslist.get(this.Questao-1).getAnswers().get(1).isCorrectAnswer() == true){//testa se alternativa é verdadeira
							this.buttonRespostaAlternativaCerta.setVisible(true);
							this.buttonRespostaAlternativaErrada.setVisible(false);
							System.out.println("correto");
						}else{
							this.buttonRespostaAlternativaCerta.setVisible(false);
							this.buttonRespostaAlternativaErrada.setVisible(true);
							this.tituloAlternativaCorretaTextView.setVisible(true);
							this.alternativaCorretaTextView.setVisible(true);
							System.out.println("errado");
							
						}
					}
					if(sender == this.buttonAlternativa2){//testa se foi clicado na 3 altern.
						if(questionslist.get(this.Questao-1).getAnswers().get(2).isCorrectAnswer() == true){//testa se alternativa é verdadeira
							this.buttonRespostaAlternativaCerta.setVisible(true);
							this.buttonRespostaAlternativaErrada.setVisible(false);
							System.out.println("correto");
						}else{
							this.buttonRespostaAlternativaCerta.setVisible(false);
							this.buttonRespostaAlternativaErrada.setVisible(true);
							this.tituloAlternativaCorretaTextView.setVisible(true);
							this.alternativaCorretaTextView.setVisible(true);
							System.out.println("errado");
							
						}
						//this.buttonRespostaAlternativa2.setPosition(10,10);
						//this.addChild(this.buttonRespostaAlternativa2);
					}
					if(sender == this.buttonAlternativa3){//testa se foi clicado na 4 altern.
						if(questionslist.get(this.Questao-1).getAnswers().get(3).isCorrectAnswer() == true){//testa se alternativa é verdadeira
							this.buttonRespostaAlternativaCerta.setVisible(true);
							this.buttonRespostaAlternativaErrada.setVisible(false);
							
						}else{
							this.buttonRespostaAlternativaCerta.setVisible(false);
							this.buttonRespostaAlternativaErrada.setVisible(true);
							this.tituloAlternativaCorretaTextView.setVisible(true);
							this.alternativaCorretaTextView.setVisible(true);
						}
					}
					//seta a informação da resposta
			}
			
		}	
	}
	
	public void createQuestions()
	{
		//Questions 1
		Questions question1 = new Questions();
		question1.setCodQuestion(1);
		question1.setQuestion("Em um processo de fissão do Urânio em que se forma o xenônio-140 (Xe), " +
				"Representeado pela equação abaixo, é formado também o estrôncio-94 (Sr) que deve ter um " +
				"numero atômico (z) igual a: ");
		
			//Answers
			question1.addAnswers(new Answers(question1, "19",true));
			question1.addAnswers(new Answers(question1, "36"));
			question1.addAnswers(new Answers(question1, "38"));
			question1.addAnswers(new Answers(question1, "40"));
		
		//Questions 2
		Questions question2 = new Questions();
		question2.setCodQuestion(2);
		question2.setQuestion("Em um processo de fissão do Urânio em que se forma o xnônio-140 (Xe), " +
				"representado pela equação abaixo, é formado também o estrôncio-94 (Sr) que deve ter " +
				"um número de massa (A) igual a:");
			
			//Answers
			question2.addAnswers(new Answers(question2, "93"));
			question2.addAnswers(new Answers(question2, "94",true));
			question2.addAnswers(new Answers(question2, "95"));
			question2.addAnswers(new Answers(question2, "98"));
			
			
		//Questions 3
		Questions question3 = new Questions();
		question3.setCodQuestion(3);
		question3.setQuestion("A maioria das usinas nucleares utiliza a fissão do isótopo U-235 " +
				"para a produção de energia elétrica. Nos reatores dessas usinas a energia liberada durante " +
				"a fissão nuclear é:");
				
			//Answers
			question3.addAnswers(new Answers(question3, "Absorvida por elétron. Constitui em corrente elétrica."));
			question3.addAnswers(new Answers(question3, "Liberar outros nêutrons, convertem em eletrecidade."));
			question3.addAnswers(new Answers(question3, "Ferve agua como vapor a alta pressao, aciona a turbina.",true));
			question3.addAnswers(new Answers(question3, "Transf. em energia elet. (Teoria da Relatividade) e explode."));
		
			
			
		//Questions 4
		Questions question4 = new Questions();
		question4.setCodQuestion(4);
		question4.setQuestion("Na fissão nuclear ocorre a liberação de energia de ordem de 200 MeV, que, isoladamente " +
				"pode ser considerada desprezível (trata-se de uma quantidade de energia muitíssimo menor do que aquela liberada quando se acende " +
				"um palito de fósforo. Entretanto, o total de energia liberada que se pode obter com esse tipo de processo acaba " +
				"se tornando extraordinariamente grande graças ao seguinte efeito: Cada um dos nêutrons liberados fissiona outro núcleo, que " +
				"libera outros nêutrons, os quais, por sua vez, fissionarão outros núcleos, e assim por diante." +
				"O processo inteiro ocorre em um intervalo de tempo muito curto e é chamado de:");
				
			//Answers
			Answers answer4_1 = new Answers(question4, "Reação em cadeia");
			Answers answer4_2 = new Answers(question4, "Fusão nuclear");
			Answers answer4_3 = new Answers(question4, "Interação forte");
			Answers answer4_4 = new Answers(question4, "Decaimento alfa",true);			
			question4.addAnswers(answer4_1);
			question4.addAnswers(answer4_2);
			question4.addAnswers(answer4_3);
			question4.addAnswers(answer4_4);
	
			
		questionslist.add(question1);
		questionslist.add(question2);
		questionslist.add(question3);
		questionslist.add(question4);
		
			
	}
	
	
	
}