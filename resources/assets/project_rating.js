const project_rating = [
  {
    title: 'content',
    sub_points:[
      {
        title: 'Visual Accuracy',
        description:[
          'Physics issues, bugs/image jitters. Causes motion sickness',
          'Some good representations, some poor representations.',
          'No bugs, jitters, image is accurately represented. No motion sickness.'
        ],
        rating: {
          score: 1,
          suggestion: ''
        }
      },
      {
        title: 'Creativity/Appearance',
        description:[
          'Not at all creative. Appearance bland/uninteresting.',
          'Some creativity shown. Appearance is okay.',
          'Extremely creative. Appearance is stunning.'
        ],
        rating: {
          score: 0,
          suggestion: ''
        }
      },
      {
        title: 'Appropriate Content/Tone',
        description:[
          'Any verbage (storyline, or tutorials) is confusing, flow is poor.',
          'Verbage can be understood, flow is okay.',
          'Verbage is excellent, easy to understand, and flows easily.'
        ],
        rating: {
          score: 0,
          suggestion: ''
        }
      },
      {
        title: 'Interactive',
        description:[
          'Interactivity is virtually nonexistent.',
          'Some non-required items able to be interacted with. Some expected interactivity still not present.',
          'Virtually all objects provide some level of interactivity even non-essential items in background.'
        ],
        rating: {
          score: 0,
          suggestion: ''
        }
      },
    ]
  },
  {
    title: 'gameplay',
    sub_points:[
      {
        title: 'Objectives',
        description:[
          'Game objectives vague, or overly difficult to discover.',
          'Objectives were somewhat confusting, but I figured them out.',
          'Objectives were completely clear.'
        ],
        rating: {
          score: 0,
          suggestion: ''
        }
      },
      {
        title: 'Tutorial',
        description:[
          'Useless/Doesn’t have one.',
          'I was able to figure it out, but there was definitely room for improvement.',
          'Perfect. Just enough information, not overly obrusive.'
        ],
        rating: {
          score: 0,
          suggestion: ''
        }
      },
    ]
  }
];
export default project_rating;