package br.com.joaopadilha.attomos.game.objects;

import static br.com.joaopadilha.attomos.config.DeviceSettings.screenHeight;
import static br.com.joaopadilha.attomos.config.DeviceSettings.screenResolution;
import static br.com.joaopadilha.attomos.config.DeviceSettings.screenWidth;

import org.cocos2d.actions.interval.CCFadeOut;
import org.cocos2d.actions.interval.CCScaleBy;
import org.cocos2d.actions.interval.CCSequence;
import org.cocos2d.actions.interval.CCSpawn;
import org.cocos2d.layers.CCLayer;
import org.cocos2d.opengl.CCBitmapFontAtlas;
import org.cocos2d.types.CGPoint;

import br.com.joaopadilha.attomos.config.Assets;
import br.com.joaopadilha.attomos.game.scenes.GameScene;

public class Score  extends CCLayer {
	
	private int score;
	private CCBitmapFontAtlas text;
	private CCBitmapFontAtlas textlevel;
	
	private GameScene delegate;
	
	public void setDelegate(GameScene delegate) {
		this.delegate = delegate;
	}

	public Score(){
		this.score = 0;

		this.text = CCBitmapFontAtlas.bitmapFontAtlas(
				String.valueOf(this.score),"UniSansBold_AlphaNum_50.fnt");
		
		this.text.setScale((float) 140 / 140);
		
		this.setPosition(screenWidth()-30, screenHeight()-10);
		this.addChild(this.text);
	}
	

	public void increase() {
		score++;		
		this.text.setString(String.valueOf(this.score)); 	
	}
	
	public int getScore()
	{
		return this.score;
	}
	
	public void clearScore()
	{
		this.score = 0;
		this.text.setString(String.valueOf(this.score));
	}
}
