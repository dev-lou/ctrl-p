import './bootstrap';

// Vercel Speed Insights (client-only) - only initialize in development/preview builds
if (typeof window !== 'undefined' && import.meta && import.meta.env && import.meta.env.DEV) {
	try {
		import('@vercel/speed-insights').then(mod => {
			if (mod && typeof mod.injectSpeedInsights === 'function') {
				mod.injectSpeedInsights();
			}
		}).catch(() => {
			// ignore errors - metrics are optional
		});
	} catch (e) {
		// ignore
	}
}
