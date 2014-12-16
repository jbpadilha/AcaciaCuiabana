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

import br.com.joaopadilha.attomos.game.scenes.GameScene;

public class Level  extends CCLayer {
	
	private int level;
	private CCBitmapFontAtlas text;
	
	private GameScene delegate;
	
	public void setDelegate(GameScene delegate) {
		this.delegate = delegate;
	}

	public Level(){
		this.level = 1;
		this.text = CCBitmapFontAtlas.bitmapFontAtlas(
				String.valueOf("nivel: "+this.level),"UniSansBold_AlphaNum_50_red.fnt");
		
		this.text.setScale((float) 80 / 80);
		
		this.setPosition(screenWidth()-40, screenHeight()-35);
		this.addChild(this.text);
	}

	public void increase() {
		level++;		
		this.text.setString(String.valueOf("nivel: "+this.level)); 
		
	}
	public void decrease() {
		level--;		
		this.text.setString(String.valueOf("nivel: "+this.level)); 
	}
	
	public int getActualLevel()
	{
		return this.level;
	}
	
}
