package br.com.casadocodigo.bis.game.objects;

import static br.com.casadocodigo.bis.config.DeviceSettings.screenHeight;
import static br.com.casadocodigo.bis.config.DeviceSettings.screenResolution;
import static br.com.casadocodigo.bis.config.DeviceSettings.screenWidth;

import java.util.Random;

import org.cocos2d.actions.instant.CCCallFunc;
import org.cocos2d.actions.interval.CCFadeOut;
import org.cocos2d.actions.interval.CCScaleBy;
import org.cocos2d.actions.interval.CCSequence;
import org.cocos2d.actions.interval.CCSpawn;
import org.cocos2d.nodes.CCDirector;
import org.cocos2d.nodes.CCSprite;
import org.cocos2d.sound.SoundEngine;
import org.cocos2d.types.CGPoint;

import br.com.casadocodigo.bis.R;
import br.com.casadocodigo.bis.config.Assets;
import br.com.casadocodigo.bis.config.Runner;
import br.com.casadocodigo.bis.game.interfaces.MeteorsEngineDelegate;


public class Meteor extends CCSprite {

	private MeteorsEngineDelegate delegate;
	private float x, y;
	private int neutronHit = 0;
	private int timesdown = 0;

	public Meteor(String image) {
		super(image);
		x = new Random().nextInt(Math.round(screenWidth()));
		y = screenHeight();
	}
	public Meteor(String image,float posx, float posy) {
		super(image);
		x = posx;
		y = posy;
		neutronHit = 1;
	}

	public void start() {
		this.schedule("update");
	}

	public void update(float dt) {
		
		// pause
		if (Runner.check().isGamePlaying() && !Runner.check().isGamePaused()) {
			y -= Runner.getActualVelocity();
			this.setPosition(screenResolution(CGPoint.ccp(x, y)));
			timesdown++;
		}
		if(neutronHit == 1 && timesdown == 7){
			this.removeMe();
			this.delegate.removeMeteor(this);
			this.unschedule("update");
		}
	}

	public void setDelegate(MeteorsEngineDelegate delegate) {
		this.delegate = delegate;
	}

	// hit
	public void shooted() {

		// PLay explosion
		SoundEngine.sharedEngine().playEffect(CCDirector.sharedDirector().getActivity(), R.raw.bang);
		
		float dt = 0.5f;
		CCScaleBy a1 = CCScaleBy.action(dt, 5f);
		CCFadeOut a2 = CCFadeOut.action(dt);
		CCSpawn s1 = CCSpawn.actions(a1, a2);
		this.runAction(CCSequence.actions(s1));
		/*try {
			Thread.sleep(1000);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}*/
		// Remove from Game Array
		this.delegate.removeMeteor(this);
/*
		// Stop Shoot
		this.unschedule("update");

		// Call RemoveMe
		CCCallFunc c1 = CCCallFunc.action(this, "removeMe");

		// Run actions!
		this.runAction(CCSequence.actions(s1, c1));
*/
	}

	public void removeMe() {
		this.removeFromParentAndCleanup(true);
	}
	
	public void hitDuplicate(CCSprite player)
	{
		shooted();
		Meteor meteor1 = new Meteor(Assets.METEOR_HITED,player.getPosition().x-60,player.getPosition().y);
		
		Meteor meteor2 = new Meteor(Assets.METEOR_HITED,player.getPosition().x+60,player.getPosition().y);
		
		this.delegate.createMeteor(meteor1);

		//meteor1.removeMe();
		
		this.delegate.createMeteor(meteor2);
	}
	
	public int getTypeNeutron(){
		return neutronHit;
	}
}
