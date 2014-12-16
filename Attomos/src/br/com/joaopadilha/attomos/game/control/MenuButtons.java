package br.com.joaopadilha.attomos.game.control;

import static br.com.joaopadilha.attomos.config.DeviceSettings.screenHeight;
import static br.com.joaopadilha.attomos.config.DeviceSettings.screenResolution;
import static br.com.joaopadilha.attomos.config.DeviceSettings.screenWidth;

import org.cocos2d.layers.CCLayer;
import org.cocos2d.nodes.CCDirector;
import org.cocos2d.transitions.CCFadeTransition;
import org.cocos2d.types.CGPoint;

import br.com.joaopadilha.attomos.config.Assets;
import br.com.joaopadilha.attomos.config.Runner;
import br.com.joaopadilha.attomos.game.scenes.GameScene;
import br.com.joaopadilha.attomos.game.scenes.TitleScreen;


public class MenuButtons extends CCLayer implements ButtonDelegate {

	private Button playButton;
	private Button highscoredButton;
	private Button nextButton;
	private Button playButton1;
	
	public MenuButtons(int nextTittle) {

		// Enable Touch
		this.setIsTouchEnabled(true);
		
		if(nextTittle >= 1 && nextTittle <= 4){
			this.nextButton = new Button(Assets.NEXT);
			this.nextButton.setDelegate(this);
			nextButton.setPosition(screenResolution(CGPoint.ccp( screenWidth()-50 , 50 ))) ;
			addChild(nextButton);
		}
		else if(nextTittle == 5){
			this.playButton1 = new Button(Assets.PLAY);
			this.playButton1.setDelegate(this);
			playButton1.setPosition(screenResolution(CGPoint.ccp( screenWidth()/2 , 50 ))) ;
			addChild(playButton1);
		}
		else{
			// Create Buttons
			this.playButton 	  = new Button(Assets.PLAY);
			//this.highscoredButton = new Button(Assets.HIGHSCORE);

			// Set Buttons Delegates
			this.playButton.setDelegate(this);
			//this.highscoredButton.setDelegate(this);
			
			// set position
			setButtonspPosition(nextTittle);
			
			// Add Buttons to Screen
			addChild(playButton);
			//addChild(highscoredButton);
		}
		
	}

	private void setButtonspPosition(int nextTittle) {

		// Buttons Positions
		playButton.setPosition(screenResolution(CGPoint.ccp( screenWidth() /2 , screenHeight() - 250 ))) ;
		//highscoredButton.setPosition(screenResolution(CGPoint.ccp( screenWidth() /2 , screenHeight() - 300 ))) ;
	}

	@Override
	public void buttonClicked(Button sender) {
		
		if (sender.equals(this.playButton1)) {
			CCDirector.sharedDirector().replaceScene(CCFadeTransition.transition(1.0f,GameScene.createGame()));	
		}
		else if (sender.equals(this.playButton) || sender.equals(this.nextButton)) {
			Runner.nextButtonIncrease();
			CCDirector.sharedDirector().replaceScene(new TitleScreen(Runner.getNextButton()).scene());
		}
		
		if (sender.equals(this.highscoredButton)) {
			System.out.println("Button clicked: Highscore");
		}

	}

}
