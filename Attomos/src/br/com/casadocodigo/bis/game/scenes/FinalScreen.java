package br.com.casadocodigo.bis.game.scenes;

import static br.com.casadocodigo.bis.config.DeviceSettings.screenHeight;
import static br.com.casadocodigo.bis.config.DeviceSettings.screenResolution;
import static br.com.casadocodigo.bis.config.DeviceSettings.screenWidth;

import org.cocos2d.layers.CCLayer;
import org.cocos2d.layers.CCScene;
import org.cocos2d.nodes.CCDirector;
import org.cocos2d.nodes.CCSprite;
import org.cocos2d.sound.SoundEngine;
import org.cocos2d.types.CGPoint;

import br.com.casadocodigo.bis.R;
import br.com.casadocodigo.bis.config.Assets;
import br.com.casadocodigo.bis.config.Runner;
import br.com.casadocodigo.bis.game.control.Button;
import br.com.casadocodigo.bis.game.control.ButtonDelegate;
import br.com.casadocodigo.bis.screens.ScreenBackground;


public class FinalScreen extends CCLayer implements ButtonDelegate{

	private ScreenBackground background;
	private Button beginButton;
	private Button nextButton;
	
	public CCScene scene() {
		CCScene scene = CCScene.node();
		scene.addChild(this);
		return scene;
	}
	
	public FinalScreen(int nextFinal) {
		
		if(nextFinal == 0){
			this.background = new ScreenBackground(Assets.BACKGROUND_TELA_FINAL);
		}
		else if(nextFinal == 1){
			this.background = new ScreenBackground(Assets.BACKGROUND_TELA_FINAL1);
		}
		else{
			this.background = new ScreenBackground(Assets.BACKGROUND);
			// sound
			SoundEngine.sharedEngine().playSound(CCDirector.sharedDirector().getActivity(), R.raw.finalend, true);
			// image
			CCSprite title = CCSprite.sprite(Assets.FINALEND);
			title.setPosition(screenResolution(CGPoint.ccp( screenWidth() /2 , screenHeight() - 130 ))) ;
			this.addChild(title);
		}
		
		this.background.setPosition(screenResolution(CGPoint.ccp(screenWidth() / 2.0f, screenHeight() / 2.0f)));
		this.addChild(this.background);

		// Enable Touch
		this.setIsTouchEnabled(true);
		if(nextFinal == 0 || nextFinal == 1){
			this.nextButton = new Button(Assets.NEXT);
			this.nextButton.setDelegate(this);
			nextButton.setPosition(screenResolution(CGPoint.ccp( screenWidth()-50 , 50 ))) ;
			addChild(nextButton);
		}else{
			this.beginButton = new Button(Assets.PLAY);
			this.beginButton.setPosition(screenResolution(CGPoint.ccp( screenWidth() /2 , screenHeight() - 300 ))) ;
		}
		
		this.beginButton.setDelegate(this);
		addChild(this.beginButton);
	}

	@Override
	public void buttonClicked(Button sender) {
		if (sender.equals(this.beginButton)) {
			if(Runner.getFinalButton() == 0 || Runner.getFinalButton() == 1){
				Runner.finalButtonIncrease();
				CCDirector.sharedDirector().replaceScene(new FinalScreen(Runner.getFinalButton()).scene());
			}
		}
		else if (sender.equals(this.beginButton)) {
			SoundEngine.sharedEngine().pauseSound();
			Runner.resetNexButton();
			CCDirector.sharedDirector().replaceScene(new TitleScreen(Runner.getNextButton()).scene());
		}		
	}	
	
}