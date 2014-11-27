package br.com.casadocodigo.bis.game.objects;

import static br.com.casadocodigo.bis.config.DeviceSettings.screenHeight;
import static br.com.casadocodigo.bis.config.DeviceSettings.screenWidth;

import org.cocos2d.layers.CCLayer;
import org.cocos2d.opengl.CCBitmapFontAtlas;

import br.com.casadocodigo.bis.game.scenes.GameScene;

public class Life  extends CCLayer {
	
	private int life;
	private CCBitmapFontAtlas text;
	
	private GameScene delegate;
	
	public void setDelegate(GameScene delegate) {
		this.delegate = delegate;
	}

	public Life(){
		this.life = 0;

		this.text = CCBitmapFontAtlas.bitmapFontAtlas(
				String.valueOf(this.life),"UniSansBold_AlphaNum_50_red.fnt");
		
		this.text.setScale((float) 240 / 240);
		
		this.setPosition(screenWidth()-10, screenHeight()-10);
		this.addChild(this.text);
	}

	public void increase() {
		life++;		
		this.text.setString(String.valueOf(this.life)); 
		
	}
	public void decrease() {
		life--;		
		this.text.setString(String.valueOf(this.life)); 
	}
	
	public int getActualLife()
	{
		return this.life;
	}
	
}
