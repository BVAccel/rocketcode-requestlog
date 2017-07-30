<?php

namespace Rocketcode\RequestLog\Http\Middleware;

use Log;
use Closure;

use Rocketcode\RequestLog\Models\RequestLog;
use Rocketcode\RequestLog\Models\RequestLogEvent;
use Illuminate\Support\Facades\Route;

class RequestLogMiddleware {

	private $requestLog = null;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        return $next($request);
    }

    // This creates the main log record.
    private function createRequestLog( $config, $request, $response ) {
    	if( !is_null( $this->requestLog ) )
    		return $this->requestLog;
	    $this->requestLog = RequestLog::create( [
		    'remote_address' => $request->getClientIp(),
		    'method' => $request->getMethod(),
		    'route' => "/" . $request->path(),
		    'return_code' => $response->getStatusCode()
	    ] );
    }

    // This creates the event for the request.
    private function recordRequest( $config, $request ) {
	    $headers = array_map( function( $i ) {
		    return $i[0];
	    }, $request->headers->all() );
	    $headers = urldecode( http_build_query( $headers, '', "\n") );
	    $body = http_build_query( $request->all() );
	    $event = RequestLogEvent::create( [
		    'parent_id' => $this->requestLog->id,
		    'headers' => ( $config['log.contents.request.headers'] )
			    ? $headers : null,
		    'body' => ( $config['log.contents.request.body'] )
			    ? $body : null,
	    ] );
	    $this->requestLog->request_id = $event->id;
    }

    // This creates the event for the response
	private function recordResponse( $config, $response ) {
		$headers = array_map( function( $i ) {
			return $i[0];
		}, $response->headers->all() );
		$headers = urldecode( http_build_query( $headers, '', "\n") );
		$body = $response->content();
		$event = RequestLogEvent::create( [
			'parent_id' => $this->requestLog->id,
			'headers' => ( $config['log.contents.response.headers'] )
				? $headers : null,
			'body' => ( $config['log.contents.response.body'] )
				? $body : null,
		] );
		$this->requestLog->response_id = $event->id;
	}

	// Let's do this in the terminate instead of the actual handle method.  We don't want it
	// impacting the main app.
    public function terminate( $request, $response ) {
    	$config  = array_dot( config( 'rocketcode-requestlog' ) );
		if( $config['log.enabled'] ) {
			$this->createRequestLog( $config, $request, $response );
			if( $config['log.contents.request.headers'] || $config['log.contents.request.body'] ) {
				$this->recordRequest( $config, $request );
			}
			if( $config['log.contents.response.headers'] || $config['log.contents.response.body'] ) {
				$this->recordResponse( $config, $response );
			}
			$this->requestLog->save();
		}
    }
}
