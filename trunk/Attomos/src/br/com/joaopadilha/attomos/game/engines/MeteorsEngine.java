package br.com.joaopadilha.attomos.game.engines;

import java.util.Random;

import org.cocos2d.layers.CCLayer;

import br.com.joaopadilha.attomos.config.Assets;
import br.com.joaopadilha.attomos.config.Runner;
import br.com.joaopadilha.attomos.game.interfaces.MeteorsEngineDelegate;
import br.com.joaopadilha.attomos.game.objects.Meteor;


public class MeteorsEngine extends CCLayer {

	private MeteorsEngineDelegate delegate;

	public MeteorsEngine() {
		this.schedule("meteorsEngine", 1.0f / 10f);
	}

	public void meteorsEngine(float dt) {

		// pause
		if (Runner.check().isGamePlaying() && !Runner.check().isGamePaused()) {

			if (new Random().nextInt(30) == 0) {
				this.getDelegate().createMeteor(new Meteor(Assets.METEOR));
			}

		}
	}

	public void setDelegate(MeteorsEngineDelegate delegate) {
		this.delegate = delegate;
	}

	public MeteorsEngineDelegate getDelegate() {
		return delegate;
	}

}
