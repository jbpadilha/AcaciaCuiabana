package br.com.casadocodigo.bis.game.scenes;

import static br.com.casadocodigo.bis.config.DeviceSettings.screenHeight;
import static br.com.casadocodigo.bis.config.DeviceSettings.screenResolution;
import static br.com.casadocodigo.bis.config.DeviceSettings.screenWidth;

import org.cocos2d.layers.CCLayer;
import org.cocos2d.layers.CCScene;
import org.cocos2d.nodes.CCSprite;
import org.cocos2d.types.CGPoint;

import br.com.casadocodigo.bis.config.Assets;
import br.com.casadocodigo.bis.game.control.MenuButtons;
import br.com.casadocodigo.bis.screens.ScreenBackground;


public class TitleScreen extends CCLayer {

	private ScreenBackground background;
	
	public CCScene scene() {
		CCScene scene = CCScene.node();
		scene.addChild(this);
		return scene;
	}

	/*public TitleScreen() {
			
		this.background = new ScreenBackground(Assets.BACKGROUND_INICIO);
		this.background.setPosition(screenResolution(CGPoint.ccp(screenWidth() / 2.0f, screenHeight() / 2.0f)));
		this.addChild(this.background);
		
		// logo
		// programa o logo aqui
		
		// Add options layer
		MenuButtons menuLayer = new MenuButtons();
		this.addChild(menuLayer);
		
	}*/

	public TitleScreen(int nextTittle) {
		
		if(nextTittle == 1){
			this.background = new ScreenBackground(Assets.BACKGROUND_TELA1);
		}
		else if(nextTittle == 2){
			this.background = new ScreenBackground(Assets.BACKGROUND_TELA2);
		}
		else if(nextTittle == 3){
			this.background = new ScreenBackground(Assets.BACKGROUND_TELA3);
		}
		else if(nextTittle == 4){
			this.background = new ScreenBackground(Assets.BACKGROUND_TELA4);
		}
		else{
			this.background = new ScreenBackground(Assets.BACKGROUND_INICIO);
		}
		this.background.setPosition(screenResolution(CGPoint.ccp(screenWidth() / 2.0f, screenHeight() / 2.0f)));
		this.addChild(this.background);
		
		// logo
		// programa o logo aqui
		
		// Add options layer
		MenuButtons menuLayer = new MenuButtons(nextTittle);
		this.addChild(menuLayer);
		
	}
	
}
