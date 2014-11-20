package br.com.casadocodigo.bis.game.scenes;

import static br.com.casadocodigo.bis.config.DeviceSettings.screenHeight;
import static br.com.casadocodigo.bis.config.DeviceSettings.screenResolution;
import static br.com.casadocodigo.bis.config.DeviceSettings.screenWidth;

import java.lang.reflect.InvocationTargetException;
import java.lang.reflect.Method;
import java.util.ArrayList;
import java.util.List;

import org.cocos2d.actions.interval.CCFadeOut;
import org.cocos2d.actions.interval.CCScaleBy;
import org.cocos2d.actions.interval.CCSequence;
import org.cocos2d.actions.interval.CCSpawn;
import org.cocos2d.layers.CCLayer;
import org.cocos2d.layers.CCScene;
import org.cocos2d.nodes.CCDirector;
import org.cocos2d.nodes.CCSprite;
import org.cocos2d.sound.SoundEngine;
import org.cocos2d.types.CGPoint;
import org.cocos2d.types.CGRect;

import android.content.Context;
import android.os.Vibrator;
import br.com.casadocodigo.bis.R;
import br.com.casadocodigo.bis.config.Assets;
import br.com.casadocodigo.bis.config.Runner;
import br.com.casadocodigo.bis.game.control.GameButtons;
import br.com.casadocodigo.bis.game.engines.MeteorsEngine;
import br.com.casadocodigo.bis.game.interfaces.MeteorsEngineDelegate;
import br.com.casadocodigo.bis.game.interfaces.PauseDelegate;
import br.com.casadocodigo.bis.game.interfaces.ShootEngineDelegate;
import br.com.casadocodigo.bis.game.objects.Level;
import br.com.casadocodigo.bis.game.objects.Life;
import br.com.casadocodigo.bis.game.objects.Meteor;
import br.com.casadocodigo.bis.game.objects.Player;
import br.com.casadocodigo.bis.game.objects.Score;
import br.com.casadocodigo.bis.game.objects.Shoot;
import br.com.casadocodigo.bis.screens.PauseScreen;
import br.com.casadocodigo.bis.screens.ScreenBackground;

public class GameScene extends CCLayer implements MeteorsEngineDelegate,
		ShootEngineDelegate, PauseDelegate {

	// Layers
	private CCLayer meteorsLayer;
	private CCLayer scoreLayer;
	private CCLayer lifeLayer;
	private CCLayer playerLayer;
	private CCLayer shootsLayer;
	private CCLayer layerTop;
	private CCLayer levelLayer;

	// Engines
	private MeteorsEngine meteorsEngine;

	// Arrays
	@SuppressWarnings("rawtypes")
	private ArrayList meteorsArray;
	@SuppressWarnings("rawtypes")
	private ArrayList playersArray;
	@SuppressWarnings("rawtypes")
	private ArrayList shootsArray;

	// Screens
	private PauseScreen pauseScreen;

	// Game Objects
	private Player player;
	private Score score;
	private boolean autoCalibration;
	private ScreenBackground background;
	private Life life;
	private Level level;
	
	//Limite Score para NexLevel
	private int limitNextLevel = 5;

	public static CCScene createGame() {

		// Create Scene
		GameScene layer = new GameScene();
		CCScene scene = CCScene.node();
		scene.addChild(layer);

		return scene;
	}

	private GameScene() {

		// Background
		this.background = new ScreenBackground(Assets.BACKGROUND);
		this.background.setPosition(screenResolution(CGPoint.ccp(screenWidth() / 2.0f, screenHeight() / 2.0f)));
		this.addChild(this.background);

		GameButtons gameButtonsLayer = GameButtons.gameButtons();
		gameButtonsLayer.setDelegate(this);
		this.addChild(gameButtonsLayer);

		// Create Layers
		this.meteorsLayer = CCLayer.node();
		this.playerLayer = CCLayer.node();
		this.scoreLayer = CCLayer.node();
		this.lifeLayer = CCLayer.node();
		this.levelLayer = CCLayer.node();

		this.addGameObjects();

		this.shootsLayer = CCLayer.node();
		this.layerTop = CCLayer.node();

		// Add Layers
		this.addChild(this.meteorsLayer);
		this.addChild(this.playerLayer);
		this.addChild(this.scoreLayer);
		this.addChild(this.lifeLayer);
		this.addChild(this.shootsLayer);
		this.addChild(this.layerTop);
		this.addChild(this.levelLayer);
		
		this.setIsTouchEnabled(true);

		// sons
		// exercicio 6 
		// adicione musica ao jogo

		preloadCache();
	}

	private void preloadCache() {
		SoundEngine.sharedEngine().preloadEffect(
				CCDirector.sharedDirector().getActivity(), R.raw.shoot);

		SoundEngine.sharedEngine().preloadEffect(
				CCDirector.sharedDirector().getActivity(), R.raw.bang);

		SoundEngine.sharedEngine().preloadEffect(
				CCDirector.sharedDirector().getActivity(), R.raw.over);
	}

	private void addGameObjects() {
		this.meteorsArray = new ArrayList();
		this.meteorsEngine = new MeteorsEngine();

		this.player = new Player();
		// exercicio 4
		// adicione o player ao jogo
		this.playerLayer.addChild(this.player);
		
		// score
		this.score = new Score();
		this.score.setDelegate(this);
		this.scoreLayer.addChild(this.score);
		
		// Life
		this.life = new Life();
		this.life.setDelegate(this);
		this.lifeLayer.addChild(this.life);
		
		// Level
		this.level = new Level();
		this.level.setDelegate(this);
		this.levelLayer.addChild(this.level);
		
		// startgame
		this.playersArray = new ArrayList();
		this.playersArray.add(this.player);

		this.shootsArray = new ArrayList();
		this.player.setDelegate(this);
	}

	public void startGame() {

		// Set Game Status
		// PAUSE
		Runner.check().setGamePlaying(true);
		Runner.check().setGamePaused(false);

		// Catch Accelerometer
		// exercicio 7
		// Habilite o acelerometro
		player.catchAccelerometer();
		// pause
		SoundEngine.sharedEngine().setEffectsVolume(1f);
		SoundEngine.sharedEngine().setSoundVolume(1f);

		// startgame
		this.schedule("checkHits");

		this.startEngines();
		
	}

	@Override
	public void onEnter() {
		super.onEnter();

		// Start Game when transition did finish
		if (!this.autoCalibration) {
			this.startGame();
		}
	}

	// startgame
	public void checkHits(float dt) {

		this.checkRadiusHitsOfArray(this.meteorsArray, this.shootsArray, this, "meteoroHit");
		this.checkRadiusHitsOfArray(this.meteorsArray, this.playersArray, this, "playerHit");

	}

	private boolean checkRadiusHitsOfArray(List<? extends CCSprite> array1,	List<? extends CCSprite> array2, GameScene gameScene, String hit) {

		boolean result = false;

		for (int i = 0; i < array1.size(); i++) {
			// Get Object from First Array
			CGRect rect1 = getBoarders(array1.get(i));

			for (int j = 0; j < array2.size(); j++) {
				// Get Object from Second Array
				CGRect rect2 = getBoarders(array2.get(j));

				// Check Hit!
				// exercicio 5
				if (CGRect.intersects(rect1, rect2)) {
					System.out.println("Colision Detected: " + hit);
					result = true;
					Method method;
					try {
						method = GameScene.class.getMethod(hit, CCSprite.class,	CCSprite.class);

						method.invoke(gameScene, array1.get(i), array2.get(j));

					} catch (SecurityException e1) {
						e1.printStackTrace();
					} catch (NoSuchMethodException e1) {
						e1.printStackTrace();
					} catch (IllegalArgumentException e) {
						e.printStackTrace();
					} catch (IllegalAccessException e) {
						e.printStackTrace();
					} catch (InvocationTargetException e) {
						e.printStackTrace();
					}
				}
			}
		}

		return result;
	}

	public CGRect getBoarders(CCSprite object) {
		CGRect rect = object.getBoundingBox();
		CGPoint GLpoint = rect.origin;
		CGRect GLrect = CGRect.make(GLpoint.x, GLpoint.y, rect.size.width,
				rect.size.height);

		return GLrect;
	}

	private void startEngines() {
		this.addChild(this.meteorsEngine);
		this.meteorsEngine.setDelegate(this);
	}

	@Override
	public void createMeteor(Meteor meteor) {

		this.meteorsLayer.addChild(meteor);
		meteor.setDelegate(this);
		meteor.start();
		this.meteorsArray.add(meteor);

	}
	
	public void createPlayer(Player player) {

		this.playerLayer.addChild(player);
		player.setDelegate(this);
		this.playersArray.add(player);
	}

	public boolean shoot() {
		player.shoot();
		return true;
	}

	@Override
	public void createShoot(Shoot shoot) {

		this.shootsLayer.addChild(shoot);
		shoot.setDelegate(this);
		shoot.start();
		this.shootsArray.add(shoot);

	}

	public void moveLeft() {
		player.moveLeft();
	}

	public void moveRight() {
		player.moveRight();
	}

	public void meteoroHit(CCSprite meteor, CCSprite shoot) {
		((Meteor) meteor).shooted();
		((Shoot) shoot).explode();
		this.score.increase();
		if(this.level.getActualLevel() == Runner.getMaximoLevel())
		{
			CCDirector.sharedDirector().replaceScene(new FinalScreen(Runner.getFinalButton()).scene());
		}
		else if(this.score.getScore() == Runner.getLimitScoreLevel())
		{
			this.score.clearScore();
			this.level.increase();
			Runner.ActualVelocityIncrease();
		}
	}

	@Override
	public void removeMeteor(Meteor meteor) {
		this.meteorsArray.remove(meteor);

	}

	@Override
	public void removeShoot(Shoot shoot) {
		this.shootsArray.remove(shoot);

	}

	public void playerHit(CCSprite meteor, CCSprite player) {
		if(((Meteor) meteor).getTypeNeutron() != 1){
			((Meteor) meteor).hitDuplicate(player);
			Vibrator v = (Vibrator) CCDirector.theApp.getSystemService(Context.VIBRATOR_SERVICE);
			if(this.life.getActualLife() <= 0){
				float x = ((Player) player).getPosition().x;
				float y = ((Player) player).getPosition().y;
				((Player) player).explode();
				this.meteorsArray.clear();
				v.vibrate(4000);
				Player player1 = new Player(Assets.ATOMO,x-90,y);
				Player player2 = new Player(Assets.ATOMO,x+90,y);
				createPlayer(player1);
				createPlayer(player2);
				/*try {
					Thread.sleep(3000);
				} catch (InterruptedException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}*/
				float dt = 0.3f;
				CCScaleBy a1 = CCScaleBy.action(dt, 10f);
				CCFadeOut a2 = CCFadeOut.action(dt);
				CCSpawn s1 = CCSpawn.actions(a1, a2);
				this.runAction(CCSequence.actions(s1));
				
				//CCDirector.sharedDirector().replaceScene(new GameOverScreen(Runner.getFinalButton()).scene());
				CCDirector.sharedDirector().replaceScene(new QuizScreen(1).scene());
			}
			else
			{
				v.vibrate(500);
				this.life.decrease();
			}
		}
	}

	// PAUSE
	// ===========
	public void pauseGameAndShowLayer() {

		if (Runner.check().isGamePlaying() && !Runner.check().isGamePaused()) {
			this.pauseGame();
		}

		if (Runner.check().isGamePaused() && Runner.check().isGamePlaying()
				&& this.pauseScreen == null) {

			this.pauseScreen = new PauseScreen();
			this.layerTop.addChild(this.pauseScreen);
			this.pauseScreen.setDelegate(this);
		}

	}

	private void pauseGame() {
		if (!Runner.check().isGamePaused() && Runner.check().isGamePlaying()) {
			Runner.setGamePaused(true);
		}
	}

	@Override
	public void resumeGame() {
		if (Runner.check().isGamePaused() || !Runner.check().isGamePlaying()) {

			// Resume game
			this.pauseScreen = null;
			Runner.setGamePaused(false);
			this.setIsTouchEnabled(true);
		}
	}

	@Override
	public void quitGame() {
		SoundEngine.sharedEngine().setEffectsVolume(0f);
		SoundEngine.sharedEngine().setSoundVolume(0f);

		CCDirector.sharedDirector().replaceScene(new TitleScreen(0).scene());

	}

	public void startFinalScreen() {
		CCDirector.sharedDirector().replaceScene(new FinalScreen(Runner.getFinalButton()).scene());
	}

}
