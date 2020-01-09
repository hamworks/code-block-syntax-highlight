/**
 * WordPress dependencies
 */
import { Component } from '@wordpress/element';
import { PlainText } from '@wordpress/editor';

/**
 * @typedef {object} wp.codeEditor~CodeEditorInstance
 * @property {object} settings - The code editor settings.
 * @property {CodeMirror} codemirror - The CodeMirror instance.
 */

const { wp } = window;

/**
 * wp.codeEditor
 *
 * @type {CodeEditorInstance}
 */
const { codeEditor } = wp;

export default class CodeEdit extends Component {
	constructor( props ) {
		super( props );
		this.state = {
			value: '',
		};
		this.initialize = this.initialize.bind( this );
		this.updateValue = this.updateValue.bind( this );
	}

	componentDidMount() {
		if ( document.readyState === 'complete' ) {
			this.initialize();
		} else {
			window.addEventListener( 'DOMContentLoaded', this.initialize );
		}
	}

	componentWillUnmount() {
		this.updateValue();
		this.editor.codemirror.toTextArea();
		this.editor.codemirror.off( 'keyHandled' );
		this.editor = null;
	}

	componentDidUpdate( prevProps, prevState ) {
		if ( prevState.value !== this.editor.codemirror.doc.getValue() ) {
			this.updateValue();
		}
		if ( prevProps.mode !== this.getMode() ) {
			console.log( this.getMode() );
			this.editor.codemirror.setOption( 'mode', this.getMode() );
		}
	}

	updateValue() {
		const { onChange } = this.props;
		if ( this.editor ) {
			this.setState( { value: this.editor.codemirror.doc.getValue() } );
			onChange( this.editor.codemirror.doc.getValue() );
			this.editor.codemirror.save();
		}
	}

	initialize() {
		const mode = this.getMode() || 'htmlmixed';
		const codemirrorSettings = codeEditor.defaultSettings.codemirror;
		this.editor = codeEditor.initialize( this.props.id, {
			codemirror: {
				...codemirrorSettings,
				mode,
			},
		} );
		this.updateValue();
		this.editor.codemirror.on( 'keyHandled', ( cm, name, event ) => event.stopPropagation() );
		this.editor.codemirror.on( 'change', () => this.updateValue() );
	}

	getMode() {
		const { mode } = this.props;
		switch ( String( mode ).toLowerCase() ) {
			case 'css':
			case 'scss':
			case 'text/css':
			case 'text/x-scss':
			case 'text/x-less':
				return 'css';
			case 'html':
			case 'htmlmixed':
			case 'text/html':
			case 'php':
			case 'application/x-httpd-php':
			case 'text/x-php':
				return 'htmlmixed';
			case 'javascript':
			case 'application/ecmascript':
			case 'application/json':
			case 'application/javascript':
			case 'application/ld+json':
			case 'text/typescript':
			case 'application/typescript':
				return 'javascript';
		}
		return 'htmlmixed';
	}

	render() {
		return <PlainText { ...this.props } />;
	}
}
