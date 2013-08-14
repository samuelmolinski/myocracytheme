<?PHP
$type = get_class($exception);
$code = $exception->getCode();
$message = $exception->getMessage();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="en-US">
<head>
<title>Oops! <?PHP echo $message; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots"  content="NOINDEX, NOFOLLOW" />
<?php

// Unique error identifier
$error_id = uniqid('error');

?>
<style type="text/css">
#core_error { background: #ddd; font-size: 1em; font-family:sans-serif; text-align: left; color: #111; margin-top: 40px; }
#core_error h1,
#core_error h2 { margin: 0; padding: 1em; font-size: 1em; font-weight: normal; background: #ef4823; color: #fff; }
    #core_error h1 a,
    #core_error h2 a { color: #fff; }
#core_error h2 { background: #222; }
#core_error h3 { margin: 0; padding: 0.4em 0 0; font-size: 1em; font-weight: normal; }
#core_error p { margin: 0; padding: 0.2em 0; }
#core_error a { color: #1b323b; }
#core_error pre { overflow: auto; white-space: pre-wrap; }
#core_error table { width: 100%; display: block; margin: 0 0 0.4em; padding: 0; border-collapse: collapse; background: #fff; }
    #core_error table td { border: solid 1px #ddd; text-align: left; vertical-align: top; padding: 0.4em; }
#core_error div.content { padding: 0.4em 1em 1em; overflow: hidden; }
#core_error pre.source { margin: 0 0 1em; padding: 0.4em; background: #fff; border: dotted 1px #b7c680; line-height: 1.2em; }
    #core_error pre.source span.line { display: block; }
    #core_error pre.source span.highlight { background: #f0eb96; }
        #core_error pre.source span.line span.number { color: #666; }
#core_error ol.trace { display: block; margin: 0 0 0 2em; padding: 0; list-style: decimal; }
    #core_error ol.trace li { margin: 0; padding: 0; }
.js .collapsed { display: none; }
</style>
<script type="text/javascript">
document.documentElement.className = 'js';
function toggle(elem)
{
    elem = document.getElementById(elem);

    if (elem.style && elem.style['display'])
        // Only works with the "style" attr
        var disp = elem.style['display'];
    else if (elem.currentStyle)
        // For MSIE, naturally
        var disp = elem.currentStyle['display'];
    else if (window.getComputedStyle)
        // For most other browsers
        var disp = document.defaultView.getComputedStyle(elem, null).getPropertyValue('display');

    // Toggle the state of the "display" style
    elem.style.display = disp == 'block' ? 'none' : 'block';
    return false;
}
</script>
</head>
<body>
   
<div id="core_error">
    <h1><span class="type"><?php echo $type ?> [ <?php echo WPFuel::$php_errors[$code] ?> ]:</span> <span class="message"><?php echo clsHTML::chars($message) ?></span></h1>
    <h2><span class="type">URI: <?PHP echo $_SERVER['REQUEST_URI']; ?></span></h2>
    <div id="<?php echo $error_id ?>" class="content">
        <p><span class="file"><?php echo clsDebug::path($exception->getFile()) ?> [ <?php echo $exception->getLine() ?> ]</span></p>
        <?php echo clsDebug::source($exception->getFile(), $exception->getLine()) ?>
        <ol class="trace">
        <?php if(isset($trace)): ?>
            <?php foreach (clsDebug::trace($trace) as $i => $step): ?>
                <li>
                    <p>
                        <span class="file">
                            <?php if ($step['file']): $source_id = $error_id.'source'.$i; ?>
                            <a href="#<?php echo $source_id ?>" onclick="return toggle('<?php echo $source_id ?>')"><?php echo clsDebug::path($step['file']) ?> [ <?php echo $step['line'] ?> ]</a>
                            <?php else: ?>
                                {<?php echo 'PHP internal call' ?>}
                            <?php endif ?>
                        </span>
                        &raquo;
                        <?php echo $step['function'] ?>(<?php if ($step['args']): $args_id = $error_id.'args'.$i; ?><a href="#<?php echo $args_id ?>" onclick="return toggle('<?php echo $args_id ?>')"><?php echo 'arguments' ?></a><?php endif ?>)
                    </p>
                    <?php if (isset($args_id)): ?>
                    <div id="<?php echo $args_id ?>" class="collapsed">
                        <table cellspacing="0">
                        <?php foreach ($step['args'] as $name => $arg): ?>
                            <tr>
                                <td><code><?php echo $name ?></code></td>
                                <td><pre><?php echo clsDebug::dump($arg) ?></pre></td>
                            </tr>
                        <?php endforeach ?>
                        </table>
                    </div>
                    <?php endif ?>
                    <?php if (isset($source_id)): ?>
                        <pre id="<?php echo $source_id ?>" class="source collapsed"><code><?php echo $step['source'] ?></code></pre>
                    <?php endif ?>
                </li>
                <?php unset($args_id, $source_id); ?>
            <?php endforeach ?>
        <?php endif; ?>
        </ol>
    </div>
    <h2><a href="#<?php echo $env_id = $error_id.'environment' ?>" onclick="return toggle('<?php echo $env_id ?>')"><?php echo 'Environment' ?></a></h2>
    <div id="<?php echo $env_id ?>" class="content collapsed">
        <?php $included = get_included_files() ?>
        <h3><a href="#<?php echo $env_id = $error_id.'environment_included' ?>" onclick="return toggle('<?php echo $env_id ?>')"><?php echo 'Included files' ?></a> (<?php echo count($included) ?>)</h3>
        <div id="<?php echo $env_id ?>" class="collapsed">
            <table cellspacing="0">
                <?php foreach ($included as $file): ?>
                <tr>
                    <td><code><?php echo clsDebug::path($file) ?></code></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
        <?php foreach (array('_SESSION', '_GET', '_POST', '_FILES', '_COOKIE', '_SERVER') as $var): ?>
        <?php if (empty($GLOBALS[$var]) OR ! is_array($GLOBALS[$var])) continue ?>
        <h3><a href="#<?php echo $env_id = $error_id.'environment'.strtolower($var) ?>" onclick="return toggle('<?php echo $env_id ?>')">$<?php echo $var ?></a></h3>
        <div id="<?php echo $env_id ?>" class="collapsed">
            <table cellspacing="0">
                <?php foreach ($GLOBALS[$var] as $key => $value): ?>
                <tr>
                    <td><code><?php echo clsHTML::chars($key) ?></code></td>
                    <td><pre><?php echo clsDebug::dump($value) ?></pre></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
        <?php endforeach ?>
    </div>
</div>
</body>
</html>